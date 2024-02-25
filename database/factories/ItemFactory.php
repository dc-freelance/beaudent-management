<?php

namespace Database\Factories;

use App\Models\ItemCategory;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items>
 */
class ItemFactory extends Factory
{
    public function definition(): array
    {
        $faker = $this->faker;
        $faker->addProvider(new \Bezhanov\Faker\Provider\Medicine($faker));
        $itemCategories = ItemCategory::all();
        $itemUnits      = Unit::all();

        return [
            'name'        => $faker->medicine,
            'category_id' => $itemCategories->random()->id,
            'unit_id'     => $itemUnits->random()->id,
            'total_stock' => $faker->numberBetween(1, 100),
            'hpp'         => 0,
            'type'        => $this->faker->randomElement(['Medicine', 'BMHP']),
        ];
    }
}
