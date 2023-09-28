<div class="row" id="popup">
    <div class="col ">
        <div class="custom-popup">
            <div class="popup-content">
                <div class="popup-text-container">
                    <div class="div_text">
                    <?php foreach ($data_images as $index => $data) : ?>
                        <div class="text">
                            <div class="text-wrapper-1">
                            <<?php echo $css_data['title_size']; ?>><?php echo $data->title ?></<?php echo $css_data['title_size']; ?>>
                            </div>
                            <div class="text-wrapper-2">
                                <?php echo $data->desc ?>
                            </div>
                        </div>
                        <div class="link" data-id="0" data-image="<?php echo wp_get_attachment_url($data->img);  ?>">
                            <a href="<?php echo esc_url($data->link) ?>" target="_blank" rel="noopener noreferrer">
                                <div type="button" class="tombol"><?php echo $data->button_link ?></div>
                            </a>
                        </div>
                    <?php endforeach; ?>    
                    </div>
                </div>
                <button title="close" class="close-button"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2807 14.2193C15.3504 14.289 15.4056 14.3717 15.4433 14.4628C15.4811 14.5538 15.5005 14.6514 15.5005 14.7499C15.5005 14.8485 15.4811 14.9461 15.4433 15.0371C15.4056 15.1281 15.3504 15.2109 15.2807 15.2806C15.211 15.3502 15.1283 15.4055 15.0372 15.4432C14.9462 15.4809 14.8486 15.5003 14.7501 15.5003C14.6515 15.5003 14.5539 15.4809 14.4629 15.4432C14.3718 15.4055 14.2891 15.3502 14.2194 15.2806L8.00005 9.06024L1.78068 15.2806C1.63995 15.4213 1.44907 15.5003 1.25005 15.5003C1.05103 15.5003 0.860156 15.4213 0.719426 15.2806C0.578695 15.1398 0.499634 14.949 0.499634 14.7499C0.499634 14.5509 0.578695 14.36 0.719426 14.2193L6.93974 7.99993L0.719426 1.78055C0.578695 1.63982 0.499634 1.44895 0.499634 1.24993C0.499634 1.05091 0.578695 0.860034 0.719426 0.719304C0.860156 0.578573 1.05103 0.499512 1.25005 0.499512C1.44907 0.499512 1.63995 0.578573 1.78068 0.719304L8.00005 6.93962L14.2194 0.719304C14.3602 0.578573 14.551 0.499512 14.7501 0.499512C14.9491 0.499512 15.1399 0.578573 15.2807 0.719304C15.4214 0.860034 15.5005 1.05091 15.5005 1.24993C15.5005 1.44895 15.4214 1.63982 15.2807 1.78055L9.06036 7.99993L15.2807 14.2193Z" fill="white" />
                    </svg></button>
                <?php foreach ($data_images as $index => $data) : ?>
                <div class="slides">

                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>