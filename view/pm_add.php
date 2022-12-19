<!DOCTYPE html>
<html>
<form>
    <div id="menu"> Register Part to Machine</div>
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
            <div class="col-25">
                <select name="partprio">
                    <option value="high">High</option>
                    <option value="medium" selected>Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="partused"> Part </label>
            </div>
            <div class="col-25">
                <input id="partused" type="number" step="any" name="partused" autocomplete="off" placeholder="Used">
            </div>
            <div class="col-25 " style="margin-left:2%">
                <input id="sprpart" type="number" step="any" name="sprpart" placeholder="Spare">
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
                <input type="button" onClick="register_pm();" name="button" value="Matching">
            </div>
        </div>
    </div>
</form>
</html>