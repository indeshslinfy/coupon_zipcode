<?php
/**
 *  Amazon Product API Library
 *
 *  @author Marc Littlemore
 *  @link 	http://www.marclittlemore.com
 *
 */
namespace MarcL;

use MarcL\CurlHttpRequest;
use MarcL\AmazonUrlBuilder;
use MarcL\Transformers\DataTransformerFactory;

class AmazonAPI
{
	private $urlBuilder = NULL;
	private $dataTransformer = NULL;

	// Valid names that can be used for search
	private $mValidSearchNames = array('All',
									'Apparel',
									'Appliances',
									'Automotive',
									'Baby',
									'Beauty',
									'Blended',
									'Books',
									'Classical',
									'DVD',
									'Electronics',
									'Grocery',
									'HealthPersonalCare',
									'HomeGarden',
									'HomeImprovement',
									'Jewelry',
									'KindleStore',
									'Kitchen',
									'Lighting',
									'Marketplace',
									'MP3Downloads',
									'Music',
									'MusicTracks',
									'MusicalInstruments',
									'OfficeProducts',
									'OutdoorLiving',
									'Outlet',
									'PetSupplies',
									'PCHardware',
									'Shoes',
									'Software',
									'SoftwareVideoGames',
									'SportingGoods',
									'Tools',
									'Toys',
									'VHS',
									'Video',
									'VideoGames',
									'Watches');

	private $mErrors = array();
	public function __construct($urlBuilder, $outputType)
	{
		$this->urlBuilder = $urlBuilder;
		$this->dataTransformer = DataTransformerFactory::create($outputType);
	}

	public function GetValidSearchNames()
	{
		return $this->mValidSearchNames;
	}

	/**
	 * Search for items
	 *
	 * @param	keywords			Keywords which we're requesting
	 * @param	searchIndex			Name of search index (category) requested. NULL if searching all.
	 * @param	sortBy				Category to sort by, only used if searchIndex is not 'All'
	 * @param	condition			Condition of item. Valid conditions : Used, Collectible, Refurbished, All
	 *
	 * @return	mixed				SimpleXML object, array of data or false if failure.
	 */
	public function ItemSearch($filters=array())
	{
		$params = array('Operation' => 'ItemSearch',
						'ResponseGroup' => 'ItemAttributes,Offers,Images',
						'ItemPage' => '1',
						'Availability' => 'Available',
						'Condition' => 'All',
						'Keywords' => 'Amazon',
						'SearchIndex' => 'All');

		if (array_key_exists('condition', $filters))
		{
			$params['Condition'] = trim($filters['condition']);
		}

		if (array_key_exists('keyword', $filters) && trim($filters['keyword']) != '')
		{
			$params['Keywords'] = trim($filters['keyword']);
		}

		if (array_key_exists('type_val', $filters) && trim($filters['type_val']) != '')
		{
			// CATEGORY
			$params['SearchIndex'] = trim($filters['type_val']);
		}

		if (array_key_exists('min_discount', $filters))
		{
			$params['MinPercentageOff'] = $filters['min_discount'];
		}

		if (array_key_exists('price_range', $filters) && $params['SearchIndex'] != 'All' && $params['SearchIndex'] != 'Blended')
		{
			$params['MinimumPrice'] = (int) $filters['price_range'][0] * 100;
			if ((int) $filters['price_range'][1] * 100 > 0)
			{
				$params['MaximumPrice'] = (int) $filters['price_range'][1] * 100;
			}

			$params['sort'] = 'price';
		}

		if ($params['SearchIndex'] == 'All' && intval($filters['paginate']['page']) > 5)
		{
			$params['ItemPage'] = '5';
		}
		else
		{
			$params['ItemPage'] = $filters['paginate']['page'];
		}

		if ($params['Availability'] == 'Available')
		{
			$params['Condition'] = 'All';
		}
		
		return $this->MakeAndParseRequest($params);
	}

	/**
	 * Lookup items from ASINs
	 *
	 * @param	asinList			Either a single ASIN or an array of ASINs
	 * @param	onlyFromAmazon		True if only requesting items from Amazon and not 3rd party vendors
	 *
	 * @return	mixed				SimpleXML object, array of data or false if failure.
	 */
	public function ItemLookup($asinList, $onlyFromAmazon = false)
	{
		if (is_array($asinList))
		{
			$asinList = implode(',', $asinList);
		}

		$params = array('Operation' => 'ItemLookup',
						'ResponseGroup' => 'ItemAttributes,Offers,Reviews,Images,Large',
						'ReviewSort' => '-OverallRating',
						'ItemId' => $asinList,
						'MerchantId' => ($onlyFromAmazon == true) ? 'Amazon' : 'All');

		return $this->MakeAndParseRequest($params);
	}

	public function GetErrors()
	{
		return $this->mErrors;
	}

	private function AddError($error)
	{
		array_push($this->mErrors, $error);
	}

	private function MakeAndParseRequest($params)
	{
		$signedUrl = $this->urlBuilder->generate($params);
		try
		{
			$request = new CurlHttpRequest();
			$response = $request->execute($signedUrl);

			$parsedXml = simplexml_load_string($response);
			if ($parsedXml === false)
			{
				return false;
			}

			return $this->dataTransformer->execute($parsedXml);
		}
		catch(\Exception $error)
		{
			$this->AddError("Error downloading data : $signedUrl : " . $error->getMessage());
			return false;
		}
	}
}
?>