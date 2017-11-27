<hr/>
<div class="acf-fields">

    <div class="acf-field" style="width: 20%;" data-width="25">
        <div class="acf-label">
            <label for="">Minute</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[minute]">
                    <?php for($i=0;$i<60;$i++): ?>
                        <?php if($i==0): ?>
                            <option value="*">Each Minute</option>
                        <?php else: ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 20%;" data-width="25">
        <div class="acf-label">
            <label for="">Hour</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[hour]">
                    <?php for($i=0;$i<24;$i++): ?>
                        <?php if($i==0): ?>
                            <option value="*">Each Hour</option>
                        <?php else: ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 20%;" data-width="25">
        <div class="acf-label">
            <label for="">Date</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[date]">
                    <?php for($i=0;$i<=31;$i++): ?>
                        <?php if($i==0): ?>
                            <option value="*">Each Date</option>
                        <?php else: ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 20%;" data-width="25">
        <div class="acf-label">
            <label for="">Day</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[day]">
                    <option value="*">Each Day</option>
                    <option value="sat">Saturday</option>
                    <option value="sun">Sunday</option>
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednesday</option>
                    <option value="thu">Thursday</option>
                    <option value="fri">Friday</option>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 20%;" data-width="25">
        <div class="acf-label">
            <label for="">Month</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[month]">
                    <option value="*">Each Month</option>
                    <option value="jan">January</option>
                    <option value="feb">February</option>
                    <option value="mar">March</option>
                    <option value="apr">April</option>
                    <option value="may">May</option>
                    <option value="jun">June</option>
                    <option value="jul">July</option>
                    <option value="aug">August</option>
                    <option value="sep">September</option>
                    <option value="oct">October</option>
                    <option value="nov">November</option>
                    <option value="dec">December</option>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 100%;" data-width="25">
        <div class="acf-label">
            <label for="">Command</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <input type="text" id=""  name="wps_schedule[command]" value="" placeholder="enter the command">
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 100%;" data-width="25">
        <input type="button" accesskey="a" value="Add Schedule" class="button button-primary" id="wpstatus_add_schedule" data-cmp="wpstatusCronAddSchedule" name="wps_schedule[submit]">
    </div>
</div>