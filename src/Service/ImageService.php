<?php

namespace App\Service;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageService
{

    public function __construct(private readonly ImageRepository $imageRepository)
    {
    }

    private function createStep($options)
    {
        $options = (new OptionsResolver())
            ->setDefaults(
                [
                    'type' => 'file',
                    'image' => null
                ]
            )->resolve($options);
        $h =
        [
            'name' => $options['type'],
            'data' => [
                'fileParams' => [
                    '@attributes' => [
                    ]
                ],
                '@attributes' => [
                ]
            ],
            'image' => $options['image']
        ];
        return $h;
    }

    public function getHistory(Image $image)
    {

        /*
        history consists of the history record, plus
          - the .thumb.jpg file if it exists
          - a JPEG of the same name if it's raw
          - anything with the same root filename, e.g. image-name.version3.jpg
        */
        $h = [];

        if ($image->isRaw()) {
            // check if there's an associated .thumb
            $jpeg = str_replace('.RAF', '.thumb.jpg', (string) $image->getName());
            if($relatedImage = $this->imageRepository->findOneBy([
                'name' => $jpeg,
            ])) {
                $h[] = $this->createStep(['image' => $relatedImage]);
            }

            // check if there's an associated .JPG in the same directory or in ../JPG
            $jpeg = str_replace('RAF', 'JPG', (string) $image->getName());
            if($relatedImage = $this->imageRepository->findOneBy([
                'name' => $jpeg,
            ])) {
                $h[] = $this->createStep(['image' => $relatedImage]);
            }
        }


        if ($imageHistory = $image->getImageHistory()) {
            if ( ($xml = simplexml_load_string((string) $imageHistory->getHistoryXml())) && ($children = $xml->children()) )
            {
                foreach ($children as $child) {
                    $image = null;
                    $data = json_decode(json_encode($child, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
                    if ($child->getName() == 'file') {
                        if ($hash = $data['fileParams']['@attributes']['fileHash'] ?? null) {
                            $image = $this->imageRepository->findOneBy(['uniqueHash' => $hash]);
                        }
                    }
                    $h[] = [
                        'name' => $child->getName(),
                        'data' => $data,
                        'image' => $image
                    ];
                }
            }
        }
        return $h;
    }

}

