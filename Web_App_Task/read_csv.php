<?php
use GoDigital\DataBaseOpr;

//DataBase Connection
require_once 'DataBaseOpr.php';
$db = new DataBaseOpr();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 53687091, ",")) !== FALSE) {
            
            $Date1 = "";
            if (isset($column[0])) {
                $Date1 = mysqli_real_escape_string($conn, $column[0]);
            }
            $Open = "";
            if (isset($column[1])) {
                $Open = mysqli_real_escape_string($conn, $column[1]);
            }
            $High = "";
            if (isset($column[2])) {
                $High = mysqli_real_escape_string($conn, $column[2]);
            }
            $Low = "";
            if (isset($column[3])) {
                $Low = mysqli_real_escape_string($conn, $column[3]);
            }
            $Close = "";
            if (isset($column[4])) {
                $Close = mysqli_real_escape_string($conn, $column[4]);
            }
            $WAP = "";
            if (isset($column[5])) {
                $WAP = mysqli_real_escape_string($conn, $column[5]);
            }
            $No_Of_Shares = "";
            if (isset($column[6])) {
                $No_Of_Shares = mysqli_real_escape_string($conn, $column[6]);
            }
            $No_Of_Trades = "";
            if (isset($column[7])) {
                $No_Of_Trades = mysqli_real_escape_string($conn, $column[7]);
            }
            $Total_Turnover = "";
            if (isset($column[8])) {
                $Total_Turnover = mysqli_real_escape_string($conn, $column[8]);
            }
             $Deliverable = "";
            if (isset($column[9])) {
                $Deliverable = mysqli_real_escape_string($conn, $column[9]);
            }
             $Per_Of_Del_Qty_To_Trd_Qty = "";
            if (isset($column[10])) {
                $Per_Of_Del_Qty_To_Trd_Qty = mysqli_real_escape_string($conn, $column[10]);
            }
             $Spread_H_L = "";
            if (isset($column[11])) {
                $Spread_H_L = mysqli_real_escape_string($conn, $column[11]);
            }
             $Spread_C_O = "";
            if (isset($column[12])) {
                $Spread_C_O = mysqli_real_escape_string($conn, $column[12]);
            }
            
            $sqlInsert = "INSERT into task_task_task (Date1,Open,High,Low,Close,WAP,No_Of_Shares,No_Of_Trades,Total_Turnover,Deliverable,Per_Of_Del_Qty_To_Trd_Qty,Spread_H_L,Spread_C_O)
                   values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "sdddddiiiiddd";
            $paramArray = array(
                $Date1,
                $Open,
                $High,
                $Low,
                $Close,
                $WAP,
                $No_Of_Shares,
                $No_Of_Trades,
                $Total_Turnover,
                $Deliverable,
                $Per_Of_Del_Qty_To_Trd_Qty,
                $Spread_H_L,
                $Spread_C_O
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (!empty($insertId)) {
                 $type = "error";
                $message = "Problem in Importing CSV Data";
            } else {
               
                $type = "success";
                $message = "CSV Data Imported into the Database";
       
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>

<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 1450px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;

    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;

    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body bgcolor="lightgreen">
    <h2>Import CSV file into Mysql using PHP</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-12 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        <html>
        <head>
            
            <title>Plot a Graph</title>
        </head>
        <body>
            <a href="plot_graph_date_data.php">Plot Graph Date Vs Close !!</a>
        
        </body>
        </html>
        
               <?php
            $sqlSelect = "SELECT * FROM task_task_task";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='BSETable'>
            <thead>
                <tr>
                        <th>Date1</th>
                        <th>Open</th>
                        <th>High</th>
                        <th>Low</th>
                        <th>Close</th>
                        <th>WAP</th>
                        <th>No_Of_Shares</th>
                        <th>No_Of_Trades</th>
                        <th>Total_Turnover</th>
                        <th>Deliverable</th>
                        <th>Per_Of_Del_Qty_To_Trd_Qty</th>
                        <th>Spread_H_L</th>
                        <th>Spread_C_O</th>
                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['Date1']; ?></td>
                    <td><?php  echo $row['Open']; ?></td>
                    <td><?php  echo $row['High']; ?></td>
                    <td><?php  echo $row['Low']; ?></td>
                    <td><?php  echo $row['Close']; ?></td>
                    <td><?php  echo $row['WAP']; ?></td>
                    <td><?php  echo $row['No_Of_Shares']; ?></td>
                    <td><?php  echo $row['No_Of_Trades']; ?></td>
                    <td><?php  echo $row['Total_Turnover']; ?></td>
                    <td><?php  echo $row['Deliverable']; ?></td>
                    <td><?php  echo $row['Per_Of_Del_Qty_To_Trd_Qty']; ?></td>
                    <td><?php  echo $row['Spread_H_L']; ?></td>
                     <td><?php  echo $row['Spread_C_O']; ?></td>



                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>