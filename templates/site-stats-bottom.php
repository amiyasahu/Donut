<div class="donut-site-stats-bottom">
    <div class="container">
        <div class="row">
            <div class="stats-wrap">
                <?php
                    donut_stats_output( qa_opt( 'cache_qcount' ), 'main/1_question', 'main/x_questions' );
                    donut_stats_output( qa_opt( 'cache_acount' ), 'main/1_answer', 'main/x_answers' );

                    if ( qa_opt( 'comment_on_qs' ) || qa_opt( 'comment_on_as' ) )
                        donut_stats_output( qa_opt( 'cache_ccount' ), 'main/1_comment', 'main/x_comments' );

                    donut_stats_output( qa_opt( 'cache_userpointscount' ), 'main/1_user', 'main/x_users' );
                ?>
            </div>
        </div>
    </div>
</div>