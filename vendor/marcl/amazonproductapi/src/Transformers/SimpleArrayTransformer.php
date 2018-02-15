<?php
namespace MarcL\Transformers;
use MarcL\Transformers\IDataTransformer;

class SimpleArrayTransformer implements IDataTransformer
{
    public function execute($xmlData)
    {
		$items = array();
		if (empty($xmlData))
		{
			throw new \Exception("No XML response found from AWS.");
		}

		if (empty($xmlData->Items))
		{
			return($items);
		}

		if ($xmlData->Items->Request->IsValid != 'True')
		{
			$errorCode = $xmlData->Items->Request->Errors->Error->Code;
			$errorMessage = $xmlData->Items->Request->Errors->Error->Message;
			$error = "API ERROR ($errorCode) : $errorMessage";
			throw new \Exception($error);
		}

		// Get each item
		foreach($xmlData->Items->Item as $responseItem)
		{
			$item = array();
			$item['asin'] = (string) $responseItem->ASIN;
			$item['url'] = (string) $responseItem->DetailPageURL;
			$item['title'] = (string) $responseItem->ItemAttributes->Title;
			
			$item['rrp'] = '$0.00';
			if ($responseItem->ItemAttributes->ListPrice->FormattedPrice)
			{
				$item['rrp'] = ((float) $responseItem->ItemAttributes->ListPrice->Amount) / 100.0;
			}
			

			$item['lowestPrice'] = 0.00;
			if ($responseItem->OfferSummary->LowestNewPrice)
			{
				$item['lowestPrice'] = ((float) $responseItem->OfferSummary->LowestNewPrice->Amount) / 100.0;
			}

			// Images
			$item['largeImage'] = (string) $responseItem->LargeImage->URL;
			$item['mediumImage'] = (string) $responseItem->MediumImage->URL;
			$item['smallImage'] = (string) $responseItem->SmallImage->URL;

			array_push($items, $item);
		}
		
		return($items);
	}
}
?>