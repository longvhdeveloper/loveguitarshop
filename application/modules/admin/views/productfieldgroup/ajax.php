<table class="table table-hover" id="fieldlist"
    style="margin-top: -60px;">
    <thead>
        <tr>
            <th>Product group field</th>
            <th>Product field</th>
        </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="2"><a href="javascript:void(0)" id="addgroup"
        class="pull-right">[+] Add group</a></td>
    </tr>
    </tfoot>
    <tbody>
        <tr class="template_row hideinit">
            <td>
                <div class="row pfg">
                    <div class="col-md-2 pfgdisplayorder">
                        <input class="form-control" type="text"
                        name="fpgfdisplayordernew[]" placeholder="Display order">
                    </div>
                    <div class="col-md-8 pfgname">
                        <input class="form-control fpfgnamenew" type="text"
                        name="fpfgnamenew[]" placeholder="Name...">
                    </div>
                    <div class="col-md-1 delpfg">
                        <a class="delgroupfieldnew" href="javascript:void(0)"><i
                        class="fa fa-trash-o"></i></a>
                    </div>
                </div>
            </td>
            <td>
                <div class="row pf">
                    <div class="col-md-2 pfdisplayorder">
                        <input class="form-control" type="text"
                        name="fpfdisplayordernew[][]" placeholder="Display order....">
                    </div>
                    <div class="col-md-5 pfname">
                        <input class="form-control fpfnamenew" type="text"
                        name="fpfnamenew[][]" placeholder="Name...">
                    </div>
                    <div class="col-md-3 pfdatatype">
                        <select class="form-control" name="fpfdatatypenew[][]">
                            <?php
                            foreach ($datatype as $id => $value) {
                            echo '<option value="' . $id . '">' . $value . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 pfunit">
                        <input class="form-control" type="text" name="fpfunitnew[][]"
                        placeholder="Unit...">
                    </div>
                    <div class="col-md-1 delpfg">
                        <a class="delfieldnew" href="javascript:void(0)"><i
                        class="fa fa-trash-o"></i></a>
                    </div>
                </div> <a style="margin-top: 15px;" href="javascript:void(0)"
            class="pull-right addfield">[+] Add field</a>
        </td>
    </tr>
    <?php
    if (isset($productfieldgroups) && ! empty($productfieldgroups)) {
    foreach ($productfieldgroups as $key => $productfieldgroup) {
    ?>
    <tr class="">
        <td>
            <div class="row pfg">
                <div class="col-md-2 pfgdisplayorder">
                    <input class="form-control" type="text"
                    name="fpgfdisplayorder[<?php echo $productfieldgroup['pfg_id'] ?>]"
                    placeholder="Display order"
                    value="<?php echo $productfieldgroup['pfg_displayorder'] ?>">
                </div>
                <div class="col-md-8 pfgname">
                    <input class="form-control" type="text"
                    name="fpfgname[<?php echo $productfieldgroup['pfg_id'] ?>]"
                    placeholder="Name..."
                    value="<?php echo $productfieldgroup['pfg_name'] ?>">
                </div>
                <div class="col-md-1 delpfg">
                    <a href="javascript:void(0)" class="delgroupfield"
                        rel="<?php echo $productfieldgroup['pfg_id']; ?>"><i
                    class="fa fa-trash-o"></i></a>
                </div>
            </div>
        </td>
        <?php
        if (! empty($productfieldgroup['productfields'])) {
        echo '<td>';
            foreach ($productfieldgroup['productfields'] as $key2 => $productfield) {
            ?>
            <div class="row pf"
                <?php if($key2 > 0) echo 'style="margin-top:10px;"'; ?>>
                <div class="col-md-2 pfdisplayorder">
                    <input class="form-control" type="text"
                    name="fpfdisplayorder[<?php echo $productfieldgroup['pfg_id'] ?>][<?php echo $productfield['pf_id'] ?>]"
                    placeholder="Display order...."
                    value="<?php echo $productfield['pf_displayorder']; ?>">
                </div>
                <div class="col-md-5 pfname">
                    <input class="form-control" type="text"
                    name="fpfname[<?php echo $productfieldgroup['pfg_id'] ?>][<?php echo $productfield['pf_id'] ?>]"
                    placeholder="Name..."
                    value="<?php echo $productfield['pf_name'] ?>">
                </div>
                <div class="col-md-3 pfdatatype">
                    <select class="form-control"
                        name="fpfdatatype[<?php echo $productfieldgroup['pfg_id'] ?>][<?php echo $productfield['pf_id'] ?>]">
                        <?php
                        foreach ($datatype as $id => $value) {
                        if ($id == $productfield['pf_datatype']) {
                        echo '<option selected value="' . $id . '">' . $value . '</option>';
                        } else {
                        echo '<option value="' . $id . '">' . $value . '</option>';
                        }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 pfunit">
                    <input class="form-control" type="text"
                    name="fpfunit[<?php echo $productfieldgroup['pfg_id'] ?>][<?php echo $productfield['pf_id'] ?>]"
                    placeholder="Unit..."
                    value="<?php echo $productfield['pf_unit'] ?>">
                </div>
                <div class="col-md-1 delpfg">
                    <a class="delfield" href="javascript:void(0)"
                        rel="<?php echo $productfield['pf_id']; ?>"><i
                    class="fa fa-trash-o"></i></a>
                </div>
            </div>
            <?php
            }
            echo '<a style="margin-top: 15px;" href="javascript:void(0)" rel="' . $productfieldgroup['pfg_id'] . '" class="pull-right addfieldg">[+] Add field</a>';
        echo '</td>';
        } else {
        ?>
        <td>
            <div class="row pf">
                <div class="col-md-2 pfdisplayorder">
                    <input class="form-control" type="text"
                    name="fpfdisplayorderg[<?php echo $productfieldgroup['pfg_id'] ?>][]"
                    placeholder="Display order....">
                </div>
                <div class="col-md-5 pfname">
                    <input class="form-control" type="text"
                    name="fpfnameg[<?php echo $productfieldgroup['pfg_id'] ?>][]"
                    placeholder="Name...">
                </div>
                <div class="col-md-3 pfdatatype">
                    <select class="form-control"
                        name="fpfdatatypeg[<?php echo $productfieldgroup['pfg_id'] ?>][]">
                        <?php
                        foreach ($datatype as $id => $value) {
                        echo '<option value="' . $id . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 pfunit">
                    <input class="form-control" type="text"
                    name="fpfunitg[<?php echo $productfieldgroup['pfg_id'] ?>][]"
                    placeholder="Unit...">
                </div>
                <div class="col-md-1 delpfg"></div>
            </div> <a style="margin-top: 15px;" href="javascript:void(0)"
            rel="<?php echo $productfieldgroup['pfg_id']; ?>"
        class="pull-right addfieldg">[+] Add field</a>
    </td>
    <?php
    }
    ?>
</tr>
<?php
}
} else {
?>
<tr class="">
    <td>
        <div class="row pfg">
            <div class="col-md-2 pfgdisplayorder">
                <input class="form-control" type="text"
                name="fpgfdisplayordernew[1]" placeholder="Display order">
            </div>
            <div class="col-md-8 pfgname">
                <input class="form-control fpfgnamenew" type="text"
                name="fpfgnamenew[1]" placeholder="Name...">
            </div>
            <div class="col-md-1 delpfg"></div>
        </div>
    </td>
    <td>
        <div class="row pf">
            <div class="col-md-2 pfdisplayorder">
                <input class="form-control" type="text"
                name="fpfdisplayordernew[1][]" placeholder="Display order....">
            </div>
            <div class="col-md-5 pfname">
                <input class="form-control" type="text" name="fpfnamenew[1][]"
                placeholder="Name...">
            </div>
            <div class="col-md-3 pfdatatype">
                <select class="form-control" name="fpfdatatypenew[1][]">
                    <?php
                    foreach ($datatype as $id => $value) {
                    echo '<option value="' . $id . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2 pfunit">
                <input class="form-control" type="text" name="fpfunitnew[1][]"
                placeholder="Unit...">
            </div>
            <div class="col-md-1 delpfg"></div>
        </div> <a style="margin-top: 15px;" href="javascript:void(0)"
    rel="1" class="pull-right addfield">[+] Add field</a>
</td>
</tr>
<?php
}
?>
</tbody>
</table>