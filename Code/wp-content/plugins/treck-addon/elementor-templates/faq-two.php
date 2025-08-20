<?php if ('layout_two' == $settings['layout_type']) : ?>
    <div class="faq-page__right">
        <div class="faq-one__faq-box">
            <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                <?php
                foreach ($settings['layout_two_faq_lists'] as $index => $item) :
                ?>
                    <div class="accrodion <?php echo esc_attr(('yes' == $item['active_status'] ? 'active' : '')); ?>">
                        <div class="accrodion-title">
                            <?php
                            if (!empty($item['question'])) :
                                treck_basic_rendered_content($this, $item,  'question', '', 'h4');
                            endif;
                            ?>
                        </div>
                        <div class="accrodion-content">
                            <div class="inner">
                                <?php
                                if (!empty($item['answer'])) :
                                    treck_basic_rendered_content($this, $item,  'answer', '', 'p');
                                endif;
                                ?>
                            </div><!-- /.inner -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>