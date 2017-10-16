<hr/>
<div class="acf-fields">

    <div class="acf-field" style="width: 25%;" data-width="25">
        <div class="acf-label">
            <label for="">Second</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[second]">
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
                <select name="wps_schedule[minute]">
                    <?php for($i=0;$i<60;$i++): ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
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
                <select name="wps_schedule[hour]">
                    <?php for($i=0;$i<24;$i++): ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
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
                <select name="wps_schedule[day]">
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 25%;" data-width="25">
        <div class="acf-label">
            <label for="">Month</label>
            <p class="description">description goes here</p>
        </div>
        <div class="acf-input">
            <div class="acf-input-wrap">
                <select name="wps_schedule[month]">
                    <option value="Jan">January</option>
                    <option value="Feb">February</option>
                    <option value="Mar">March</option>
                    <option value="Apr">April</option>
                    <option value="May">May</option>
                    <option value="Jun">June</option>
                    <option value="Jul">July</option>
                    <option value="Aug">August</option>
                    <option value="Sep">September</option>
                    <option value="Oct">October</option>
                    <option value="Nov">November</option>
                    <option value="Dec">December</option>
                </select>
            </div>
        </div>
    </div>
    <div class="acf-field" style="width: 75%;" data-width="25">
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