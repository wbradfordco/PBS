<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Contact Form 7 Element
 */
class Widget_Eael_Contact_Form extends Widget_Base {
    
    /**
	 * Retrieve contact form 7 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'eael-contact-form-7';
    }

    /**
	 * Retrieve contact form 7 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'EA Contact Form 7', 'essential-addons-elementor' );
    }

    /**
	 * Retrieve the list of categories the contact form 7 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'essential-addons-elementor' ];
    }

    /**
	 * Retrieve contact form 7 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'fa fa-envelope-o';
    }

    /**
	 * Register contact form 7 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/
        
        /**
         * Content Tab: Contact Form
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_info_box',
            [
                'label'                 => __( 'Contact Form', 'essential-addons-elementor' ),
            ]
        );
		
		$this->add_control(
			'contact_form_list',
			[
				'label'                 => esc_html__( 'Select Form', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'label_block'           => true,
				'options'               => eael_select_contact_form(),
                'default'               => '0',
			]
		);
        
        $this->add_control(
            'form_title',
            [
                'label'                 => __( 'Form Title', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'label_on'              => __( 'On', 'essential-addons-elementor' ),
                'label_off'             => __( 'Off', 'essential-addons-elementor' ),
                'return_value'          => 'yes',
            ]
        );
		
		$this->add_control(
			'form_title_text',
			[
				'label'                 => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
                'default'               => '',
                'condition'             => [
                    'form_title'   => 'yes',
                ],
			]
		);
        
        $this->add_control(
            'form_description',
            [
                'label'                 => __( 'Form Description', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'label_on'              => __( 'On', 'essential-addons-elementor' ),
                'label_off'             => __( 'Off', 'essential-addons-elementor' ),
                'return_value'          => 'yes',
            ]
        );
		
		$this->add_control(
			'form_description_text',
			[
				'label'                 => esc_html__( 'Description', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::TEXTAREA,
                'default'               => '',
                'condition'             => [
                    'form_description'   => 'yes',
                ],
			]
		);
        
        $this->add_control(
            'labels_switch',
            [
                'label'                 => __( 'Labels', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Show', 'essential-addons-elementor' ),
                'label_off'             => __( 'Hide', 'essential-addons-elementor' ),
                'return_value'          => 'yes',
            ]
        );
        
        $this->end_controls_section();

        /**
         * Content Tab: Errors
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_errors',
            [
                'label'                 => __( 'Errors', 'essential-addons-elementor' ),
            ]
        );
        
        $this->add_control(
            'error_messages',
            [
                'label'                 => __( 'Error Messages', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'show',
                'options'               => [
                    'show'          => __( 'Show', 'essential-addons-elementor' ),
                    'hide'          => __( 'Hide', 'essential-addons-elementor' ),
                ],
                'selectors_dictionary'  => [
					'show'          => 'block',
					'hide'          => 'none',
				],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'validation_errors',
            [
                'label'                 => __( 'Validation Errors', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'show',
                'options'               => [
                    'show'          => __( 'Show', 'essential-addons-elementor' ),
                    'hide'          => __( 'Hide', 'essential-addons-elementor' ),
                ],
                'selectors_dictionary'  => [
					'show'          => 'block',
					'hide'          => 'none',
				],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;',
                ],
            ]
        );
        
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/


        /**
         * Style Tab: Form Container
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_container_style',
            [
                'label'                 => __( 'Form Container', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eael_contact_form_background',
                'label'     => __( 'Background', 'essential-addons-elementor' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .eael-contact-form',
            ]
        );
		
		$this->add_responsive_control(
			'eael_contact_form_alignment',
			[
				'label' => esc_html__( 'Form Alignment', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'essential-addons-elementor' ),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'essential-addons-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'essential-addons-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'essential-addons-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'default',
			]
		);

  		$this->add_responsive_control(
  			'eael_contact_form_width',
  			[
  				'label' => esc_html__( 'Form Width', 'essential-addons-elementor' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'default'   => [
				        'unit'  => 'px',
                        'size'  => '500'
                ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

  		$this->add_responsive_control(
  			'eael_contact_form_max_width',
  			[
  				'label' => esc_html__( 'Form Max Width', 'essential-addons-elementor' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-7-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);
		
		
		$this->add_responsive_control(
			'eael_contact_form_margin',
			[
				'label' => esc_html__( 'Form Margin', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$this->add_responsive_control(
			'eael_contact_form_padding',
			[
				'label' => esc_html__( 'Form Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'eael_contact_form_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'eael_contact_form_border',
				'selector' => '{{WRAPPER}} .eael-contact-form',
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'eael_contact_form_box_shadow',
				'selector' => '{{WRAPPER}} .eael-contact-form',
			]
		);

        $this->end_controls_section();

        /**
         * Style Tab: Title & Description
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fields_title_description',
            [
                'label'                 => __( 'Title & Description', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'heading_alignment',
            [
                'label'                 => __( 'Alignment', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'      => [
                        'title' => __( 'Left', 'essential-addons-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'essential-addons-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'essential-addons-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .eael-contact-form-7-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'title_heading',
            [
                'label'                 => __( 'Title', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .eael-contact-form-7-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'title_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .eael-contact-form-7-title',
            ]
        );
        
        $this->add_control(
            'description_heading',
            [
                'label'                 => __( 'Description', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'description_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .eael-contact-form-7-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'description_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .eael-contact-form-7-description',
            ]
        );
        
        $this->end_controls_section();
        
        /**
         * Style Tab: Input & Textarea
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fields_style',
            [
                'label'                 => __( 'Input & Textarea', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_fields_style' );

        $this->start_controls_tab(
            'tab_fields_normal',
            [
                'label'                 => __( 'Normal', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'field_bg',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}',
                ],
				'separator'         => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'input_spacing',
            [
                'label'                 => __( 'Spacing', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '20',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form p:not(:last-of-type) .wpcf7-form-control-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->add_responsive_control(
			'field_padding',
			[
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'text_indent',
            [
                'label'                 => __( 'Text Indent', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 60,
                        'step'  => 1,
                    ],
                    '%'         => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'text-indent: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'input_width',
            [
                'label'                 => __( 'Input Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'textarea_width',
            [
                'label'                 => __( 'Textarea Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'field_border',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'field_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'field_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator'             => 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'field_box_shadow',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator'             => 'before',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_fields_focus',
            [
                'label'                 => __( 'Focus', 'essential-addons-elementor' ),
            ]
        );
        
        $this->add_control(
            'field_bg_focus',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'input_border_focus',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form textarea:focus',
                'separator'             => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'focus_box_shadow',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .eael-contact-form-7 .wpcf7-form textarea:focus',
				'separator'             => 'before',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
            'section_label_style',
            [
                'label'                 => __( 'Labels', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'text_color_label',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'label_spacing',
            [
                'label'                 => __( 'Spacing', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'typography_label',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form label',
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Placeholder Section
         */
        $this->start_controls_section(
            'section_placeholder_style',
            [
                'label'                 => __( 'Placeholder', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'placeholder_switch',
            [
                'label'                 => __( 'Show Placeholder', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'essential-addons-elementor' ),
                'label_off'             => __( 'No', 'essential-addons-elementor' ),
                'return_value'          => 'yes',
            ]
        );

        $this->add_control(
            'text_color_placeholder',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'placeholder_switch'   => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'typography_placeholder',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder',
                'condition'             => [
                    'placeholder_switch'   => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Radio & Checkbox
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_radio_checkbox_style',
            [
                'label'                 => __( 'Radio & Checkbox', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'custom_radio_checkbox',
            [
                'label'                 => __( 'Custom Styles', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'label_on'              => __( 'Yes', 'essential-addons-elementor' ),
                'label_off'             => __( 'No', 'essential-addons-elementor' ),
                'return_value'          => 'yes',
            ]
        );
        
        $this->add_responsive_control(
            'radio_checkbox_size',
            [
                'label'                 => __( 'Size', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '15',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_radio_checkbox_style' );

        $this->start_controls_tab(
            'radio_checkbox_normal',
            [
                'label'                 => __( 'Normal', 'essential-addons-elementor' ),
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_checkbox_color',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"]' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'radio_checkbox_border_width',
            [
                'label'                 => __( 'Border Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 15,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_checkbox_border_color',
            [
                'label'                 => __( 'Border Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"]' => 'border-color: {{VALUE}}',
                ],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'checkbox_heading',
            [
                'label'                 => __( 'Checkbox', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
            ]
        );

		$this->add_control(
			'checkbox_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
			]
		);
        
        $this->add_control(
            'radio_heading',
            [
                'label'                 => __( 'Radio Buttons', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
            ]
        );

		$this->add_control(
			'radio_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"], {{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'radio_checkbox_checked',
            [
                'label'                 => __( 'Checked', 'essential-addons-elementor' ),
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_checkbox_color_checked',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-custom-radio-checkbox input[type="checkbox"]:checked:before, {{WRAPPER}} .eael-custom-radio-checkbox input[type="radio"]:checked:before' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'section_submit_button_style',
            [
                'label'                 => __( 'Submit Button', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
			'button_align',
			[
				'label'                 => __( 'Alignment', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::CHOOSE,
				'default'               => 'left',
				'options'               => [
					'left'        => [
						'title'   => __( 'Left', 'essential-addons-elementor' ),
						'icon'    => 'eicon-h-align-left',
					],
					'center'      => [
						'title'   => __( 'Center', 'essential-addons-elementor' ),
						'icon'    => 'eicon-h-align-center',
					],
					'right'       => [
						'title'   => __( 'Right', 'essential-addons-elementor' ),
						'icon'    => 'eicon-h-align-right',
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .eael-contact-form-7 .wpcf7-form p:nth-last-of-type(1)'   => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'display:inline-block;'
				],
                'condition'             => [
                    'button_width_type' => 'custom',
                ],
			]
		);
        
        $this->add_control(
            'button_width_type',
            [
                'label'                 => __( 'Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'custom',
                'options'               => [
                    'full-width'    => __( 'Full Width', 'essential-addons-elementor' ),
                    'custom'        => __( 'Custom', 'essential-addons-elementor' ),
                ],
                'prefix_class'          => 'eael-contact-form-7-button-',
            ]
        );
        
        $this->add_responsive_control(
            'button_width',
            [
                'label'                 => __( 'Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'button_width_type' => 'custom',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __( 'Normal', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'button_border_normal',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label'                 => __( 'Margin Top', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]',
				'separator'             => 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]',
				'separator'             => 'before',
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Errors
         */
        $this->start_controls_section(
            'section_error_style',
            [
                'label'                 => __( 'Errors', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'error_messages_heading',
            [
                'label'                 => __( 'Error Messages', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );

        $this->start_controls_tabs( 'tabs_error_messages_style' );

        $this->start_controls_tab(
            'tab_error_messages_alert',
            [
                'label'                 => __( 'Alert', 'essential-addons-elementor' ),
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );

        $this->add_control(
            'error_alert_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );
        
        $this->add_responsive_control(
            'error_alert_spacing',
            [
                'label'                 => __( 'Spacing', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-not-valid-tip' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_error_messages_fields',
            [
                'label'                 => __( 'Fields', 'essential-addons-elementor' ),
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );

        $this->add_control(
            'error_field_bg_color',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-not-valid' => 'background: {{VALUE}}',
                ],
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );

        $this->add_control(
            'error_field_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-not-valid' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'error_messages' => 'show',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'error_field_border',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-not-valid',
				'separator'             => 'before',
				'condition'             => [
					'error_messages' => 'show',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'validation_errors_heading',
            [
                'label'                 => __( 'Validation Errors', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'validation_errors' => 'show',
				],
            ]
        );

        $this->add_control(
            'validation_errors_bg_color',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-validation-errors' => 'background: {{VALUE}}',
                ],
				'condition'             => [
					'validation_errors' => 'show',
				],
            ]
        );

        $this->add_control(
            'validation_errors_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-contact-form-7 .wpcf7-validation-errors' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'validation_errors' => 'show',
				],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'validation_errors_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-validation-errors',
				'separator'             => 'before',
				'condition'             => [
					'validation_errors' => 'show',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'validation_errors_border',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eael-contact-form-7 .wpcf7-validation-errors',
				'separator'             => 'before',
				'condition'             => [
					'validation_errors' => 'show',
				],
			]
		);

		$this->add_responsive_control(
			'validation_errors_margin',
			[
				'label'                 => __( 'Margin', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-contact-form-7 .wpcf7-validation-errors' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'validation_errors' => 'show',
				],
			]
		);
        
        $this->end_controls_section();

    }

    /**
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings();
        
        $this->add_render_attribute( 'contact-form', 'class', [
				'eael-contact-form',
				'eael-contact-form-7',
                'eael-contact-form-'.esc_attr($this->get_id())
			]
		);
        
        if ( $settings['labels_switch'] != 'yes' ) {
            $this->add_render_attribute( 'contact-form', 'class', 'labels-hide' );
        }
        
        if ( $settings['placeholder_switch'] == 'yes' ) {
            $this->add_render_attribute( 'contact-form', 'class', 'placeholder-show' );
        }
        
        if ( $settings['custom_radio_checkbox'] == 'yes' ) {
            $this->add_render_attribute( 'contact-form', 'class', 'eael-custom-radio-checkbox' );
        }
        if ( $settings['eael_contact_form_alignment'] == 'left' ) {
            $this->add_render_attribute( 'contact-form', 'class', 'eael-contact-form-align-left' );
        }
        elseif ( $settings['eael_contact_form_alignment'] == 'center' ) {
            $this->add_render_attribute( 'contact-form', 'class', 'eael-contact-form-align-center' );
        }
        elseif ( $settings['eael_contact_form_alignment'] == 'right' ) {
            $this->add_render_attribute( 'contact-form', 'class', 'eael-contact-form-align-right' );
        }
        else {
            $this->add_render_attribute( 'contact-form', 'class', 'eael-contact-form-align-default' );
        }
        
        if ( function_exists( 'wpcf7' ) ) {
            if ( ! empty( $settings['contact_form_list'] ) ) { ?>
                <div class="eael-contact-form-7-wrapper">
                    <div <?php echo $this->get_render_attribute_string( 'contact-form' ); ?>>
                        <?php if ( $settings['form_title'] == 'yes' || $settings['form_description'] == 'yes' ) { ?>
                            <div class="eael-contact-form-7-heading">
                                <?php if ( $settings['form_title'] == 'yes' && $settings['form_title_text'] != '' ) { ?>
                                    <h3 class="eael-contact-form-title eael-contact-form-7-title">
                                        <?php echo esc_attr( $settings['form_title_text'] ); ?>
                                    </h3>
                                <?php } ?>
                                <?php if ( $settings['form_description'] == 'yes' && $settings['form_description_text'] != '' ) { ?>
                                    <div class="eael-contact-form-description eael-contact-form-7-description">
                                        <?php echo $this->parse_text_editor( $settings['form_description_text'] ); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '" ]' ); ?>
                    </div>
                </div>
                <?php
            }
        }
    }

    /**
	 * @access protected
	 */
    protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Eael_Contact_Form() );