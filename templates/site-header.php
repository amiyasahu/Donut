<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'/>
<div id="site-header" class="site-header text-center">
    <div class="site-header-cover">
        <div class="site-header-fade"></div>
        <div class="site-header-entry">
            <?php if (donut_opt('allow_user_to_close_home_page_banner')): ?>
                <div class="hide-btn-wrap">
                    <button title="Hide this banner" id="hide-site-header" type="button" class="close" data-dismiss="site-header-entry" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            
            <h1 class="top-heading">Donut Discussion Forum</h1>

            <div class="container visible-md visible-lg">
                <div class="col-md-4 jumbo-box">
                    <div class="wrap">
                        <div class="icon-wrap">
                            <span class="fa fa-search-plus  large-icon"></span>
                        </div>
                        <div class="hint">
                            Search answers for all your queries
                        </div>
                    </div>
                </div>
                <div class="col-md-4 jumbo-box">
                    <div class="wrap">
                        <div class="icon-wrap">
                            <span class="fa fa-question-circle large-icon"></span>
                        </div>
                        <div class="hint">
                            One destination for all your queries
                        </div>
                    </div>
                </div>
                <div class="col-md-4 jumbo-box">
                    <div class="wrap">
                        <div class="icon-wrap">
                            <span class="fa fa-check-square-o large-icon"></span>
                        </div>
                        <div class="hint">
                            Get answers from the experts
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-wrapper">
                <div class="search-bar col-lg-4 col-lg-push-4 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-10 col-xs-push-1">
                    <form class="form-inline" method="post" action="<?php echo qa_path_html('ask'); ?>">
                        <div class="form-group form-group-lg">
                            <input type="text" class="form-control input-lg ask-field" id="ask"
                                   placeholder="Type your question" name="title">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg ask-btn hidden-xs">Ask !</button>
                        <input type="hidden" name="doask1" value="1">
                    </form>
                </div>
                <!--IF you are using the default vector , you should not remove the attribution for freepik.com-->
                <div class="col-lg-12 visible-lg text-right small">vector designed by Freepik.com</div>
            </div>
        </div>
    </div>
</div>