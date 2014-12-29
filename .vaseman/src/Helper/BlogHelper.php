<?php

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;

class BlogHelper extends AbstractHelper
{
	protected $faker;

	public function getSeeder()
	{
		$faker = $this->getFaker();

		return array(
			'title' => $faker->sentence(),
			'author' => $faker->firstName . ' ' . $faker->lastName,
			'text' => $faker->paragraphs(3)
		);
	}

	public function getFaker()
	{
		if (!$this->faker)
		{
			$this->faker = \Faker\Factory::create();
		}

		return $this->faker;
	}
}
