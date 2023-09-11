<?php
/**
 * Service widget
*/
namespace CG\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Services_widget extends Widget_Base {
    public function get_name() {
        return 'custom-services-service-widget';
    }

    public function get_title() {
        return __('Service Widget', 'Services_widget');
    }

    public function get_icon() {
        return 'eicon-navigation-vertical';
    }

    public function get_categories() {
        // TODO : create own catgeory
        return [ 'basic' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => 'Content',
            )
        );
    
        $this->add_control(
            'paragraph',
            array(
                'label' => 'Content',
                'type' => Controls_Manager::TEXT,
                'default' => 'Content',
            )
        );
    
        $this->add_control(
			'title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'textdomain' ),
				'placeholder' => esc_html__( 'Enter your title', 'textdomain' ),
			]
		);

		$this->add_control(
			'size',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => esc_html__( 'Size', 'textdomain' ),
				'placeholder' => '0',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 18,
				'selectors' => [
					'{{WRAPPER}} h2.head' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Lightbox', 'textdomain' ),
				'options' => [
					'default' => esc_html__( 'Default', 'textdomain' ),
					'yes' => esc_html__( 'Yes', 'textdomain' ),
					'no' => esc_html__( 'No', 'textdomain' ),
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'alignment',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} h2.head' => 'text-align: {{VALUE}}',
				],
			]
		);

        // Styles
		$this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} h2.head' => 'color: {{VALUE}}',
				],
			]
		);

    
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
		?>
            <div class="location">
                <h2 class="head"><?= $settings['title'] ?></h2>
                <p class="content"><?= $settings['paragraph'] ?></p>
            </div>
        <?php
    }

    protected function _content_template() {
        ?>
            <div class="location">
                <h2 class="head">{{{ settings.title }}}</h2>
                <p class="content">{{ settings.paragraph }} </p>
            </div>
        <?php
    }
}