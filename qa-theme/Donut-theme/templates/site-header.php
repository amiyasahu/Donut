<div id="site-header" class="site-header text-center">
    <div class="site-header-cover">
        <div class="site-header-fade"></div>
        <div class="site-header-entry">
            <?php if ( qa_opt( 'donut_banner_closable' ) ): ?>
                <div class="hide-btn-wrap">
                    <button title="<?php echo donut_lang_html( 'hide_this_banner' ) ?>" id="hide-site-header"
                            type="button" class="close" data-dismiss="site-header-entry" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <h1 class="top-heading"><?php echo qa_opt( 'donut_banner_head_text' ) ?></h1>

            <?php if ( qa_opt( 'donut_banner_div1_text' ) or qa_opt( 'donut_banner_div2_text' ) or qa_opt( 'donut_banner_div2_text' ) or qa_opt( 'donut_banner_div1_icon' ) or qa_opt( 'donut_banner_div2_icon' ) or qa_opt( 'donut_banner_div3_icon' ) ): ?>
                <div class="container visible-md visible-lg">
                    <div class="col-md-4 jumbo-box">
                        <div class="wrap">
                            <div class="icon-wrap">
                                <span class="<?php echo qa_opt( 'donut_banner_div1_icon' ) ?>  large-icon"></span>
                            </div>
                            <div class="hint">
                                <?php echo qa_opt( 'donut_banner_div1_text' ) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 jumbo-box">
                        <div class="wrap">
                            <div class="icon-wrap">
                                <span class="<?php echo qa_opt( 'donut_banner_div2_icon' ) ?> large-icon"></span>
                            </div>
                            <div class="hint">
                                <?php echo qa_opt( 'donut_banner_div2_text' ) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 jumbo-box">
                        <div class="wrap">
                            <div class="icon-wrap">
                                <span class="<?php echo qa_opt( 'donut_banner_div3_icon' ) ?> large-icon"></span>
                            </div>
                            <div class="hint">
                                <?php echo qa_opt( 'donut_banner_div3_text' ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <div class="search-wrapper">
                <?php if ( qa_opt( 'donut_banner_show_ask_box' ) ): ?>
                    <div class="search-bar col-lg-4 col-lg-push-4 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-10 col-xs-push-1">
                        <form class="form-inline" method="post" action="<?php echo qa_path_html( 'ask' ); ?>">
                            <div class="form-group form-group-lg">
                                <input type="text" class="form-control input-lg ask-field" id="ask"
                                       placeholder="<?php echo donut_lang( 'ask_placeholder' )?>" name="title">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg ask-btn hidden-xs"><?php echo donut_lang( 'ask_button' )?></button>
                            <input type="hidden" name="doask1" value="1">
                        </form>
                    </div>
                <?php endif ?>

                <!--IF you are using the default vector , you should not remove the attribution for freepik.com-->
                <div class="col-lg-12 visible-lg text-right small">vector designed by Freepik.com</div>
            </div>
        </div>
    </div>
</div>
