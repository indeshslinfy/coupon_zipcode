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
		switch ($service_provider)
		{
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

	public function groupon_deals($params)
	{
		$CI =& get_instance();
		$CI->load->model('settings_model');

		$groupon_details = $CI->settings_model->get_settings('groupon');
		$groupon_details['wid'] = urlencode(base_url());
		switch ($params['type'])
		{
			case 'location':
				return @json_decode(utf8_encode(file_get_contents('https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&division_id=' . $params['type_val'] . '&wid=' . $groupon_details['wid'] . 'm&offset=' . $params['paginate']['offset'] . '&limit=' . $params['paginate']['limit'])));
				break;

			case 'latlong':
				return @json_decode(utf8_encode(file_get_contents('https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&lat=' . $params['type_val']['lat'] . '&lng=' . $params['type_val']['long'] . '&wid=' . $groupon_details['wid'] . 'm&offset=' . $params['paginate']['offset'] . '&limit=' . $params['paginate']['limit'])));
				break;
			
			case 'category':
				return @json_decode(utf8_encode(file_get_contents('https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&filters=category:' . $params['type_val'] . '&wid=' . $groupon_details['wid'] . 'm&offset=' . $params['paginate']['offset'] . '&limit=' . $params['paginate']['limit'])));
				break;
			
			default:
				return false;
				break;
		}
	}

	public function ebay_deals($params)
	{
		$CI =& get_instance();
		$CI->load->model('settings_model');

		$ebay_details = $CI->settings_model->get_settings('ebay');

		$api_url = 'http://svcs.ebay.com/services/search/FindingService/v1?SERVICE-VERSION=1.0.0&SECURITY-APPNAME=' . $ebay_details['app_id'] . '&GLOBAL-ID=EBAY-US&RESPONSE-DATA-FORMAT=XML&REST-PAYLOAD&paginationInput.entriesPerPage=' . $params['limit'] . '&paginationInput.pageNumber='. $params['offset'] . '&affiliate.networkId=9&affiliate.trackingId=' . $ebay_details['camp_id'] . '&affiliate.customId=123';
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

		// print_r($api_url);die;
		return json_decode(json_encode(simplexml_load_file($api_url)), true);
	}

	public function amazon_deals($params)
	{
		$CI =& get_instance();
		$CI->load->model('settings_model');

		$amazon_details = $CI->settings_model->get_settings('amazon');
		$urlBuilder = new AmazonUrlBuilder($amazon_details['keyId'],
											$amazon_details['secretKey'],
											$amazon_details['associateId'],
											$amazon_details['country']);

		$amazonAPI = new AmazonAPI($urlBuilder, 'simple');
		$items = $amazonAPI->ItemSearch($params['keyword'], $params['type_val']);

		return $items;
	}
}