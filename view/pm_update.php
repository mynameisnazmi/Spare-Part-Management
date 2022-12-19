<form>
    <div id="navhead">
        <div id="titlenav"> Update Part on Machine </div>
        <button type="button" id="del_pm">Delete</button>
    </div>
    <div id="register">
        <div class="row">
            <div class="col-25">
                <label for="area"> Area </label>
            </div>
            <div class="col-75" style="width: 25%; position:relative; z-index:10;">
                <input id="area" type="text" autocomplete="off" required placeholder="TA/N/V" onKeyup="pm_searcharea(this.value)">
                <input id="mach_id" type="hidden" name="area">
                <div class="resultsearch_area">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="itemcode"> Item code </label>
            </div>
            <div class="col-75" style="width: 25%; position:relative;z-index:1;">
                <input id="itemcode" type="text" name="itemcode" autocomplete="off" placeholder="106-XXX" onKeyup="pm_searchicode(this.value)">
                <div class="resultsearch_icode">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="partprio"> Priority </label>
            </div>
            <div class="col-25" style="width:15%;">
                <select name="partprio">
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="tempact"> Temp Actual </label>
            </div>
            <div class="col-75" style="width: 25%; position:relative;">
                <input id="tempact" type="text" name="tempact" autocomplete="off" placeholder="Degree">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lodcap"> Load Capacity </label>
            </div>
            <div class="col-75" style="width: 25%; position:relative;">
                <input id="lodcap" type="text" name="lodcap" autocomplete="off" placeholder="KiloWatts">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lodact"> Load Actual </label>
            </div>
            <div class="col-75" style="width: 25%; position:relative;">
                <input id="lodact" type="text" name="lodact" autocomplete="off" placeholder="KiloWatts">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="partused"> Used / Spare </label>
            </div>
            <div class="col-25">
                <input id="partused" type="number" step="any" name="partused" autocomplete="off" placeholder="Used">
            </div>
            <div class="col-25 " style="margin-left:2%">
                <input id="sprpart" type="number" step="any" name="sprpart" placeholder="Spare" value="1">
            </div>
        </div>
        <div class="row" style="align-items:center; margin-bottom:20px">
            <div class="col-25">
                <label for="note"> Keterangan </label>
            </div>
            <div class="col-75">
                <textarea name="note"></textarea>
            </div>
        </div>
        <div class="row">
            <div id="col-25r">
                <input type="button" id="upd_pm" name="button" value="Update">
            </div>
        </div>
    </div>
</form>