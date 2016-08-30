<?php
class PostQueryTest extends PHPUnit_Framework_TestCase
{

    public function testCreateWithSlashing()
    {
        $post = new \TypeRocket\Models\WPPost();

        $data = [
            'post_title' => 'About /TypeRocket/Namespace Code',
            'post_name' => 'about-the-code',
            'post_excerpt' => 'About /TypeRocket/Namespace Code',
            'post_content' => 'Content for the "main" /TypeRocket/Namespace \'not that much\' and that\'s it.',
        ];

        $post->create($data);

        wp_delete_post($post->ID, true);

        $content = $post->getProperty('post_content');
        $title = $post->getProperty('post_title');
        $excerpt = $post->getProperty('post_excerpt');

        $this->assertTrue($content == $data['post_content']);
        $this->assertTrue($title == $data['post_title']);
        $this->assertTrue($excerpt == $data['post_excerpt']);
    }

    public function testUpdateWithSlashing()
    {
        $post = new \TypeRocket\Models\WPPost();
        $post->findById(1);

        $data = [
            'post_title' => 'Update /TypeRocket/Namespace Code',
            'post_name' => 'about-the-code',
            'post_excerpt' => 'Update /TypeRocket/Namespace Code',
            'post_content' => 'Updated for the "main" /TypeRocket/Namespace \'not that much\' and that\'s it all.',
        ];

        $post->update($data);

        $content = $post->getProperty('post_content');
        $title = $post->getProperty('post_title');
        $excerpt = $post->getProperty('post_excerpt');

        $this->assertTrue($content == $data['post_content']);
        $this->assertTrue($title == $data['post_title']);
        $this->assertTrue($excerpt == $data['post_excerpt']);
    }

}