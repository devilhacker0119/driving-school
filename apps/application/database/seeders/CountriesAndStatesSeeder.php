<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class CountriesAndStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Country::truncate();
        State::truncate();

        $countries = [
            [
                'name'   => 'United States',
                'abbr'   => 'USA',
                'states' => [
                    ['abbr' => 'AL', 'name' => 'Alabama'],
                    ['abbr' => 'AK', 'name' => 'Alaska'],
                    ['abbr' => 'AS', 'name' => 'American Samoa'],
                    ['abbr' => 'AZ', 'name' => 'Arizona'],
                    ['abbr' => 'AR', 'name' => 'Arkansas'],
                    ['abbr' => 'CA', 'name' => 'California'],
                    ['abbr' => 'CO', 'name' => 'Colorado'],
                    ['abbr' => 'CT', 'name' => 'Connecticut'],
                    ['abbr' => 'DE', 'name' => 'Delaware'],
                    ['abbr' => 'DC', 'name' => 'District of Columbia'],
                    ['abbr' => 'FM', 'name' => 'Federated States of Micronesia'],
                    ['abbr' => 'FL', 'name' => 'Florida'],
                    ['abbr' => 'GA', 'name' => 'Georgia'],
                    ['abbr' => 'GU', 'name' => 'Guam'],
                    ['abbr' => 'HI', 'name' => 'Hawaii'],
                    ['abbr' => 'ID', 'name' => 'Idaho'],
                    ['abbr' => 'IL', 'name' => 'Illinois'],
                    ['abbr' => 'IN', 'name' => 'Indiana'],
                    ['abbr' => 'IA', 'name' => 'Iowa'],
                    ['abbr' => 'KS', 'name' => 'Kansas'],
                    ['abbr' => 'KY', 'name' => 'Kentucky'],
                    ['abbr' => 'LA', 'name' => 'Louisiana'],
                    ['abbr' => 'ME', 'name' => 'Maine'],
                    ['abbr' => 'MH', 'name' => 'Marshall Islands'],
                    ['abbr' => 'MD', 'name' => 'Maryland'],
                    ['abbr' => 'MA', 'name' => 'Massachusetts'],
                    ['abbr' => 'MI', 'name' => 'Michigan'],
                    ['abbr' => 'MN', 'name' => 'Minnesota'],
                    ['abbr' => 'MS', 'name' => 'Mississippi'],
                    ['abbr' => 'MO', 'name' => 'Missouri'],
                    ['abbr' => 'MT', 'name' => 'Montana'],
                    ['abbr' => 'NE', 'name' => 'Nebraska'],
                    ['abbr' => 'NV', 'name' => 'Nevada'],
                    ['abbr' => 'NH', 'name' => 'New Hampshire'],
                    ['abbr' => 'NJ', 'name' => 'New Jersey'],
                    ['abbr' => 'NM', 'name' => 'New Mexico'],
                    ['abbr' => 'NY', 'name' => 'New York'],
                    ['abbr' => 'NC', 'name' => 'North Carolina'],
                    ['abbr' => 'ND', 'name' => 'North Dakota'],
                    ['abbr' => 'MP', 'name' => 'Northern Mariana Islands'],
                    ['abbr' => 'OH', 'name' => 'Ohio'],
                    ['abbr' => 'OK', 'name' => 'Oklahoma'],
                    ['abbr' => 'OR', 'name' => 'Oregon'],
                    ['abbr' => 'PW', 'name' => 'Palau'],
                    ['abbr' => 'PA', 'name' => 'Pennsylvania'],
                    ['abbr' => 'PR', 'name' => 'Puerto Rico'],
                    ['abbr' => 'RI', 'name' => 'Rhode Island'],
                    ['abbr' => 'SC', 'name' => 'South Carolina'],
                    ['abbr' => 'SD', 'name' => 'South Dakota'],
                    ['abbr' => 'TN', 'name' => 'Tennessee'],
                    ['abbr' => 'TX', 'name' => 'Texas'],
                    ['abbr' => 'UT', 'name' => 'Utah'],
                    ['abbr' => 'VT', 'name' => 'Vermont'],
                    ['abbr' => 'VI', 'name' => 'Virgin Islands'],
                    ['abbr' => 'VA', 'name' => 'Virginia'],
                    ['abbr' => 'WA', 'name' => 'Washington'],
                    ['abbr' => 'WV', 'name' => 'West Virginia'],
                    ['abbr' => 'WI', 'name' => 'Wisconsin'],
                    ['abbr' => 'WY', 'name' => 'Wyoming'],
                    [
                        'abbr' => 'AE',
                        'name' => 'Armed Forces Europe, the Middle East, and Canada',
                    ],
                    ['abbr' => 'AP', 'name' => 'Armed Forces Pacific'],
                    ['abbr' => 'AA', 'name' => 'Armed Forces Americas (except Canada)'],
                ],
            ],
        ];

        foreach ($countries as $country) {
            $states = Arr::pull($country, 'states');
            $new_country = Country::firstOrCreate(['abbr' => $country['abbr']], $country);

            foreach ($states as $state) {
                $new_country->states()->create([
                    'country_id' => $new_country->id,
                    'name'       => $state['name'],
                    'abbr'       => $state['abbr'],
                ]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
