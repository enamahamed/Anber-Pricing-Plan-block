<?php
/*
 *
 * 	*****  *****
 *
 * 	Core Functions
 * 	
 */

// If this file is called directly, abort. //


use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

// Confirm Carbon Fields class existence  
if (class_exists('Carbon_Fields')) {
    // Boot the Carbon Fields only if it's not already booted  
    add_action('after_setup_theme', function () {
        Carbon_Fields::boot();
    });
}


add_action('carbon_fields_register_fields', function () {
    Block::make(__('Pricing Block', 'carbon-fields'))
            ->add_fields([
                Field::make('text', 'wpapp_service_title', __('Service Title')),
                Field::make('text', 'wpapp_service_tag', __('Service tag')),
                Field::make('complex', 'wpapp_pricing_item')
                // ->set_layout( 'tabbed-vertical' )
                ->add_fields('pricing_item', array(
                    Field::make('text', 'wpapp_pricing_title', __('Item Title')),
                    Field::make('text', 'wpapp_pricing_tag', __('Item Tag')),
                    Field::make('text', 'wpapp_pricing_price', __('Price')),
                    Field::make('text', 'wpapp_pricing_price_text', __('Price Interval')),
                    Field::make('text', 'wpapp_pricing_price_desc', __('Subscription Type')),
                    Field::make('text', 'wpapp_pricing_btn_text', __('Button Text')),
                    Field::make('text', 'wpapp_pricing_btn_url', __('Button URL')),
                    Field::make('complex', 'wpapp_pricing_item_feature')
                    ->set_layout('tabbed-vertical')
                    ->add_fields(array(
                        Field::make('text', 'wpapp_pricing_feature_item', __('Feature Item')),
                    )),
                    Field::make('select', 'wpapp_pricing_style', __('Style'))
                    ->add_options(array(
                        'light' => __('Light'),
                        'dark' => __('Dark'),
                    ))
                    ->set_default_value('light')
                ))
            ])
            ->set_icon('wordpress')
            ->set_category('common')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
<div class="anber-pricingplan-block">
                <div class="srv-title-sec">
                    <h2><?php echo esc_html($fields['wpapp_service_title']); ?></h2>
                    <p><?php echo esc_html($fields['wpapp_service_tag']); ?></p>
                </div>
                <div class="pricing-plan-wrwpper py-100">

                    <?php
                    foreach ($fields['wpapp_pricing_item'] as $item) {
                        ?>
                        <div class="pricing-item pricing-item-<?php echo $item['wpapp_pricing_style']; ?>">
                            <h2><?php echo esc_html($item['wpapp_pricing_title']); ?></h2>
                            <span class="pricing-tag"><?php echo esc_html($item['wpapp_pricing_tag']); ?></span>
                            <div class="price-wrp">
                                <h3><?php echo esc_html($item['wpapp_pricing_price']); ?></h3><span><?php echo esc_html($item['wpapp_pricing_price_text']); ?></span>
                            </div>
                            <span><?php echo esc_html($item['wpapp_pricing_price_desc']); ?></span>
                            <div class="letstalkBtn triggers">
                            <a class="price_btn" href="<?php echo esc_html($item['wpapp_pricing_btn_url']); ?>"><?php echo esc_html($item['wpapp_pricing_btn_text']); ?></a>
                            </div>
                            <ul>
                                <?php foreach ($item['wpapp_pricing_item_feature'] as $fitem) { ?>
                                    <li>
                                        <span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6125 1.36104C10.6812 0.574966 9.3188 0.574967 8.38749 1.36104L7.53932 2.07692C7.14349 2.41102 6.65365 2.61394 6.1375 2.65759L5.03155 2.75111C3.81717 2.85381 2.85381 3.81717 2.75111 5.03155L2.65759 6.1375C2.61394 6.65365 2.41102 7.14349 2.07692 7.53934L1.36104 8.38749C0.574966 9.3188 0.574967 10.6812 1.36104 11.6125L2.07692 12.4607C2.41102 12.8565 2.61394 13.3464 2.65759 13.8625L2.75111 14.9685C2.85381 16.1829 3.81717 17.1462 5.03155 17.2489L6.1375 17.3424C6.65365 17.3861 7.14349 17.589 7.53934 17.9231L8.38749 18.639C9.3188 19.425 10.6812 19.425 11.6125 18.639L12.4607 17.9231C12.8565 17.589 13.3464 17.3861 13.8625 17.3424L14.9685 17.2489C16.1829 17.1462 17.1462 16.1829 17.2489 14.9685L17.3424 13.8625C17.3861 13.3464 17.589 12.8565 17.9231 12.4607L18.639 11.6125C19.425 10.6812 19.425 9.3188 18.639 8.38749L17.9231 7.53932C17.589 7.14349 17.3861 6.65365 17.3424 6.1375L17.2489 5.03155C17.1462 3.81717 16.1829 2.85381 14.9685 2.75111L13.8625 2.65759C13.3464 2.61394 12.8565 2.41102 12.4607 2.07692L11.6125 1.36104ZM14.546 8.29555C14.9854 7.85621 14.9854 7.1439 14.546 6.70456C14.1067 6.26521 13.3944 6.26521 12.955 6.70456L8.75054 10.9091L7.04604 9.20456C6.6067 8.76521 5.89439 8.76521 5.45505 9.20456C5.0157 9.6439 5.0157 10.3562 5.45505 10.7956L7.95505 13.2955C8.39439 13.7349 9.1067 13.7349 9.54604 13.2955L14.546 8.29555Z" fill="#3ED37A"/>
                                            </svg></span>
                                        <span><?php echo esc_html($fitem['wpapp_pricing_feature_item']); ?></span>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>
                        <?php
                    }
                    ?>
                </div>
</div>
                <?php
            });
});
