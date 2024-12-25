--------------------------------------------------------------------------
js
--------------------------------------------------------------------------
<script>
      $(function() {
        $('.chosen').chosen();
      });
</script>

-----------------------------------------------------------------------
standart
---------------------------------------------------------------------
<select class="form-control chosen" data-placeholder="" name="">
<option value=""></option>;
<option value=""></option>;
</select>

--------------------------------------------------------------------
Mengambil data dari tabel lain
--------------------------------------------------------------------
<select class="form-control chosen" data-placeholder="" name="">
<option value=""></option>
<?php
    $sql = "SELECT * FROM nama_tabel";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
?>
    <option value="<?php echo $row['nama_field']; ?>"><?php echo $row['nama_field']; ?></option>
<?php
    }
?>
</select>

==============================================
