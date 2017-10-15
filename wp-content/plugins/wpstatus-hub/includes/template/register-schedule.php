<hr/>
<div class="acf-fields">

    <div class="acf-field" style="width: 25%;" data-width="25">
        <div class="acf-label">
            <label for="">Second</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select>
                    <?php for($i=0;$i<=59;$i++): ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 25%;" data-width="25">
        <div class="acf-label">
            <label for="">Minute</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select>
                    <?php for($i=0;$i<60;$i++): ?>
                        <option value="<?php echo $i;?>><?php echo $i;?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div><div class="acf-field" style="width: 25%;" data-width="25">
        <div class="acf-label">
            <label for="">Hour</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select>
                    <?php for($i=0;$i<24;$i++): ?>
                        <option value="<?php echo $i;?>><?php echo $i;?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 25%;" data-width="25">
        <div class="acf-label">
            <label for="">Day</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select>
                    <option>Saturday</option>
                    <option>Sunday</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 25%;" data-width="25">
        <input type="button" accesskey="a" value="Add Schedule" class="button button-primary" id="wpstatus_add_schedule" name="wpstatus_add_schedule">
    </div>
</div>