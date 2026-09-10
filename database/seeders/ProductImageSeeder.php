<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Product Images Directory
        |--------------------------------------------------------------------------
        */

        $directory = storage_path('app/public/products');

        if (! File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Clear Old Images
        |--------------------------------------------------------------------------
        */

        $oldFiles = File::glob($directory . '/*');

        foreach ($oldFiles as $file) {
            if (File::isFile($file)) {
                File::delete($file);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Clear Database Records
        |--------------------------------------------------------------------------
        */

        $products = Product::query()
            ->orderBy('id')
            ->get();

        foreach ($products as $product) {

            /*
            |--------------------------------------------------------------------------
            | Generate 3 Test Images
            |--------------------------------------------------------------------------
            */

            $images = [
                [
                    'filename' => $product->slug . '-1.svg',
                    'sort_order' => 1,
                    'is_primary' => true,
                ],
                [
                    'filename' => $product->slug . '-2.svg',
                    'sort_order' => 2,
                    'is_primary' => false,
                ],
                [
                    'filename' => $product->slug . '-3.svg',
                    'sort_order' => 3,
                    'is_primary' => false,
                ],
            ];


            foreach ($images as $image) {

                $path = $directory . '/' . $image['filename'];

                File::put(
                    $path,
                    $this->makePlaceholderSvg(
                        $product->name,
                        $product->brand ?? 'FARZIN',
                        $image['sort_order']
                    )
                );


                /*
                |--------------------------------------------------------------------------
                | Save Image Record
                |--------------------------------------------------------------------------
                */

                $product->images()->create([
                    'image' => 'products/' . $image['filename'],

                    'alt' => $product->name,

                    'sort_order' => $image['sort_order'],

                    'is_primary' => $image['is_primary'],
                ]);
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Placeholder SVG Generator
    |--------------------------------------------------------------------------
    */

    private function makePlaceholderSvg(
        string $productName,
        string $brand,
        int $number
    ): string {
        $productName = htmlspecialchars(
            $productName,
            ENT_QUOTES,
            'UTF-8'
        );

        $brand = htmlspecialchars(
            $brand,
            ENT_QUOTES,
            'UTF-8'
        );

        return <<<SVG
<svg
    xmlns="http://www.w3.org/2000/svg"
    width="900"
    height="900"
    viewBox="0 0 900 900"
>
    <rect
        width="900"
        height="900"
        fill="#f1f0ed"
    />

    <rect
        x="80"
        y="80"
        width="740"
        height="740"
        rx="36"
        fill="#ffffff"
        stroke="#e5e1db"
        stroke-width="3"
    />

    <circle
        cx="450"
        cy="330"
        r="155"
        fill="#f5eee6"
    />

    <rect
        x="310"
        y="250"
        width="280"
        height="160"
        rx="25"
        fill="#191919"
    />

    <rect
        x="350"
        y="290"
        width="200"
        height="80"
        rx="15"
        fill="#343434"
    />

    <circle
        cx="400"
        cy="330"
        r="11"
        fill="#b38a5a"
    />

    <circle
        cx="500"
        cy="330"
        r="11"
        fill="#b38a5a"
    />

    <text
        x="450"
        y="570"
        text-anchor="middle"
        font-family="Arial, Tahoma, sans-serif"
        font-size="30"
        font-weight="700"
        fill="#191919"
    >
        {$brand}
    </text>

    <text
        x="450"
        y="625"
        text-anchor="middle"
        font-family="Arial, Tahoma, sans-serif"
        font-size="24"
        fill="#55524e"
    >
        {$productName}
    </text>

    <text
        x="450"
        y="680"
        text-anchor="middle"
        font-family="Arial, Tahoma, sans-serif"
        font-size="18"
        fill="#7e7a74"
    >
        TEST PRODUCT IMAGE {$number}
    </text>
</svg>
SVG;
    }
}

