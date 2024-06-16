<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'status' => 'approved',
            'image' => $this->getPostImage(),
        ];
    }

    public function getPostImage()
    {
        $images = [
            '/assets/img/img_feature_news.jpg',
            '/assets/img/img_feature_news3.jpg',
            '/assets/img/img_feature.jpg',
            '/assets/img/img_feature2.jpg',
            '/assets/img/img_hockey.jpg',
            '/assets/img/category.jpg',
            '/assets/img/img-carousel1.jpg',
            '/assets/img/img-carousel2.jpg',
            '/assets/img/img-category.jpg',
            '/assets/img/img-category2.jpg',
            '/assets/img/img-category3.jpg',
            '/assets/img/img-category4.jpg',
            '/assets/img/img-category5.jpg',
            '/assets/img/img-category6.jpg',
            '/assets/img/img-category7.jpg',
            '/assets/img/img-news___.jpg',
            '/assets/img/img-news.jpg',
            '/assets/img/img-news1.jpg',
            '/assets/img/img-news2.jpg',
            '/assets/img/img-single.jpg',
        ];

        return $images[rand(0, (count($images) - 1))];
    }
}
