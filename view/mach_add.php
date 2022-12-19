<!DOCTYPE html>
<html>
<form>
<div id="menu"> Register New Location </div>
    <div id="register">
            <div class="row">
                <div class="col-25">
                    <label for="partof"> Area </label>
                </div>
                <div class="col-25">
                    <input id="partof" type="text" name="partof" autocomplete="off" required placeholder="TA/N/V">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="partloc"> Location </label>
                </div>
                <div class="col-75" style="width:50%">
                    <input id="partloc" type="text" name="partloc" autocomplete="off" placeholder="+E11 / Maindrive">
                </div>
            </div>
            <div class="row">
                <div id="col-25r">
                    <input type="button" onClick="register_mach();" name="button" value="Register">
                </div>
            </div>

        </div>
</form>


</html>