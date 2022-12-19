<form>
    <div id="navhead">
        <div id="menupart"> Update Part</div>
        <button type="button" id="del_part">Delete</button>
    </div>
    <div id="register">
        <div class="row">
            <div class="col-25">
                <label for="itemcode"> Item code </label>
            </div>
            <div class="col-75" style="width: 20%;">
                <input id="itemcode" type="text" name="itemcode" autocomplete="off" placeholder="106-XXX">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="partname"> Category </label>
            </div>
            <div class="col-75">
                <input id="partname" type="text" name="partname" autocomplete="off" placeholder="Drive / Contactor / Motor">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="spec"> Specification </label>
            </div>
            <div class="col-75">
                <input id="spec" type="text" name="spec" autocomplete="off" placeholder="SIEMENS SINAMICS 6ES7231-XXXX">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="part_sts"> Status </label>
            </div>
            <div class="col-25">
                <select name="part_sts">
                    <option value="0">Available</option>
                    <option value="1">Obsolate</option>
                </select>
            </div>
            <div class="col-25" style="width: 10%; margin-left:5%;">
                <label for="unit"> Unit </label>
            </div>
            <div class="col-25">
                <select name="unit">
                    <option value="pcs" selected>Pcs</option>
                    <option value="mtr">Meter</option>
                    <option value="can">Kaleng</option>
                    <option value="pack">Pack</option>
                    <option value="roll">Roll</option>
                    <option value="kg">Kilogram</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="fileupload_pict"> Part Image </label>
            </div>
            <div class="col-75">
                <input type="file" name="fileupload_pict" id="image" accept="image/*">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="fileupload_pdf"> Part Datasheet </label>
            </div>
            <div class="col-75">
                <input type="file" name="fileupload_pdf" id="pdf" accept="application/pdf">
            </div>
        </div>

        <div class="row">
            <div id="col-25r">
                <input type="button" id="upd" name="button" value="Update">
            </div>
        </div>

    </div>
</form>