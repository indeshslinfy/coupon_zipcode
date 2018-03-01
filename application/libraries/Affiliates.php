<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  

defined('BASEPATH') OR exit('No direct script access allowed');

require('vendor/autoload.php');
use MarcL\AmazonAPI;
use MarcL\AmazonUrlBuilder;
class Affiliates
{
	public function get_deals($service_provider, $params)
	{
		ini_set('max_execution_time', 120); // 2 minutes
		switch ($service_provider)
		{
			case 'restaurant_dot_com':
				return $this->restaurant_dot_com_deals($params);
				break;

			case 'groupon':
				return $this->groupon_deals($params);
				break;

			case 'ebay':
				return $this->ebay_deals($params);
				break;

			case 'amazon':
				return $this->amazon_deals($params);
				break;
			
			default:
				return array();
				break;
		}
	}

	public function restaurant_dot_com_deals($params)
	{
		if (!isset($params['paginate']['limit']))
		{
			$pagination_details = get_settings('deals_pagination');
			$params['paginate']['limit'] = $pagination_details['limit'];
		}

		$rdc_details = get_settings('restaurant_dot_com');
		$url = 'https://product-search.api.cj.com/v2/product-search?'.
				'website-id=' . $rdc_details['website_id'].
				'&advertiser-ids=' . $rdc_details['advertiser_id'].
				'&records-per-page='. $params['paginate']['limit'].
				'&page-number=' . $params['paginate']['page'];
		
		if (array_key_exists('keyword', $params) && $params['keyword'] != '')
		{
			$url .= '&keywords=' . rawurlencode($params['keyword']);
		}
		
		if (array_key_exists('price_range', $params))
		{
			$url .= '&low-price=' . (int) $params['price_range'][0];
			if ((int) $params['price_range'][1] > 0)
			{
				$url .= '&high-price=' . (int) $params['price_range'][1];
			}
		}

		if (array_key_exists('sort_order', $params)) 
		{
			switch ($params['sort_order'])
			{
				case 'az':
					$url .= '&sort-order=asc&sort-by=name';
					break;

				case 'za':
					$url .= '&sort-order=desc&sort-by=name';
					break;
				
				default:
					# code...
					break;
			}
		}

		try
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $rdc_details['cj_id']));
			
			$result = curl_exec($ch);
			$resultXML = simplexml_load_string($result);

			$data = json_decode(json_encode($resultXML), true);
			if ($data['products']['@attributes']['records-returned'] != '0')
			{
				if ($data['products']['@attributes']['records-returned'] == '1')
				{
					return array($data['products']['product']);
				}
				return $data['products']['product'];
			}
		}
		catch (Exception $e)
		{
			return array();
		}

		return array();
	}

	public function groupon_deals($params)
	{
		$groupon_details = get_settings('groupon');
		$groupon_details['wid'] = urlencode(base_url());

		if (!isset($params['paginate']['limit']))
		{
			$pagination_details = get_settings('deals_pagination');
			$params['paginate']['limit'] = $pagination_details['limit'];
		}

		if (!isset($params['paginate']['offset']))
		{
			$params['paginate']['offset'] = 1;
		}

		$api_url = 'https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&wid=' . $groupon_details['wid'] . 'm&offset=' . $params['paginate']['offset'] . '&limit=' . $params['paginate']['limit'];
		switch ($params['type'])
		{
			case 'location':
				$api_url .= '&division_id=' . $params['type_val'];
				break;

			case 'latlong':
				$api_url .= '&lat=' . $params['type_val']['lat'] . '&lng=' . $params['type_val']['long'];
				break;
			
			case 'category':
				$api_url .= '&filters=category:' . $params['type_val'];
				break;

			case 'ip':
			default:
				$api_url .= '&channel_id=' . $params['channel_id'];
				break;
		}

		return @json_decode(utf8_encode(file_get_contents($api_url)));
	}

	public function ebay_deals($params)
	{
		$ebay_details = get_settings('ebay');

		if (!isset($params['paginate']['limit']))
		{
			$pagination_details = get_settings('deals_pagination');
			$params['paginate']['limit'] = $pagination_details['limit'];
		}

		if (!isset($params['paginate']['offset']))
		{
			$params['paginate']['offset'] = 1;
		}
		elseif ($params['paginate']['offset'] < 1)
		{
			$params['paginate']['offset'] = 1;
		}

		$api_url = 'http://svcs.ebay.com/services/search/FindingService/v1?SERVICE-VERSION=1.0.0&SECURITY-APPNAME=' . $ebay_details['app_id'] . '&GLOBAL-ID=EBAY-US&RESPONSE-DATA-FORMAT=XML&REST-PAYLOAD&paginationInput.entriesPerPage=' . $params['paginate']['limit'] . '&paginationInput.pageNumber='. $params['paginate']['offset'] . '&affiliate.networkId=9&affiliate.trackingId=' . $ebay_details['camp_id'] . '&affiliate.customId=123';
		if (array_key_exists('sort_order', $params)) 
		{
			$api_url .= '&sortOrder='. $params['sort_order'];
		}

		if (array_key_exists('price_range', $params)) 
		{
			if (array_key_exists(0, $params['price_range']) && intval($params['price_range'][0]) > 0)
			{
				// SET MIN
				$api_url .= '&itemFilter(0).paramName=MinPrice&itemFilter(0).paramValue=' . $params['price_range'][0];
			}
			
			if (array_key_exists(1, $params['price_range']) && intval($params['price_range'][1]) > 0)
			{
				// SET MAX
				$api_url .= '&itemFilter(1).paramName=MaxPrice&itemFilter(1).paramValue=' . $params['price_range'][0];
			}

			$api_url .= '&itemFilter(2).paramName=Currency&itemFilter(2).paramValue=' . $params['currency'];
		}

		switch ($params['type'])
		{
			case 'category':
				$api_url .= '&categoryId=' . $params['type_val'] . '&OPERATION-NAME=findItemsByCategory';
				break;

			case 'keyword':
				$api_url .= '&keywords=' . $params['type_val'] . '&OPERATION-NAME=findItemsByKeywords';
				break;

			case 'advanced':
				$api_url .= '&categoryId=' . $params['cat'][0] . '&keywords=' . $params['keyword'] . '&OPERATION-NAME=findItemsAdvanced';
				break;

			case 'zipcode':
				$api_url .= '&buyerPostalCode=' . $params['type_val'] . '&itemFilter.name=MaxDistance&itemFilter.value=25&keywords=' . $params['keyword'] . '&OPERATION-NAME=findItemsAdvanced';
				break;

			default:
				$api_url .= '&keywords=ebay&OPERATION-NAME=findItemsByKeywords';
				break;
		}

		return json_decode(json_encode(simplexml_load_file($api_url)), true);
	}

	public function amazon_deals($params)
	{
		$amazon_details = get_settings('amazon');
		$urlBuilder = new AmazonUrlBuilder($amazon_details['keyId'],
											$amazon_details['secretKey'],
											$amazon_details['associateId'],
											$amazon_details['country']);

		$amazonAPI = new AmazonAPI($urlBuilder, 'simple');
		return $amazonAPI->ItemSearch($params);
	}
}