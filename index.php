<!DOCTYPE html>
<html>

<head>
    <title>Tax Calculator</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--Compiled and minified jQuery-->
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="js/utils.js"></script>-->
    <script type="text/javascript" src="js/script.js"></script>

</head>

<body>
    <!--Header section-->
    <header>
    </header>
    <!--Navigation section-->
    <!--
       <nav>
        <ul>
            <li><a href="#">item1</a></li>
            <li><a href="#">item2</a></li>
            <li><a href="#">item3</a></li>
            <li><a href="#">item4</a></li>
            <li><a href="#">item5</a></li>
        </ul>
    </nav>
    -->
    <!--Main content section-->
    <section>
        <h1 class="title">Take-Home Tax Calculator</h1>
        <div>
            <form action="index.php" method="post">
                <div class="input-line">
                    <span class="salary-label">Salary:</span> &pound;<input type="number" name="value" required><br>
                </div>
                <div class="input-line">
                    Age:
                    <div class="input-radio">
                        <span>&lt;69</span>
                        <div class="roundedOne">
                            <input type="radio" name="age" id="below69" value="below69" checked>
                            <label for="below69"></label>
                        </div>
                    </div>
                    <div class="input-radio">
                        <span>69-78</span>
                        <div class="roundedOne">
                            <input type="radio" name="age" id="6978" value="6978">
                            <label for="6978"></label>
                        </div>
                    </div>
                    <div class="input-radio">
                        <span>79+</span>
                        <div class="roundedOne">
                            <input type="radio" name="age" id="above79" value="above79">
                            <label for="above79"></label>
                        </div>
                    </div>
                </div>

                <div class="input-line">
                    <div class="input-check">
                        <span>Married</span>
                        <div class="slideThree">
                            <input name="married" id="married" value="1" type="checkbox">
                            <label for="married"></label>
                        </div>
                    </div>
                    <div class="input-check">
                        <span>Blind</span>
                        <div class="slideThree">
                            <input name="blind" id="blind" value="1" type="checkbox">
                            <label for="blind"></label>
                        </div>
                    </div>
                    <div class="input-check">
                        <span>No NI</span>
                        <div class="slideThree">
                            <input name="NIcheck" id="NIcheck" value="1" type="checkbox">
                            <label for="NIcheck"></label>
                        </div>
                    </div>
                </div>
                <!--<input name="scottish" value="1" type="checkbox"><span>Resident in Scotland</span><br>-->
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Tax code</a></li>
                        <li><a href="#tabs-2">Student loan</a></li>
                        <!--<li><a href="#tabs-3">Bonus</a></li>-->
                        <li><a href="#tabs-4">Overtime</a></li>
                        <li><a href="#tabs-5">Pension</a></li>
                        <li><a href="#tabs-6">Childcare</a></li>
                        <li><a href="#tabs-7">Salary Sacrifice</a></li>
                        <li><a href="#tabs-8">Taxable Benefits</a></li>
                        <li><a href="#tabs-9">Other Deductions</a></li>
                    </ul>
                    <div id="tabs-1">
                        <span class="intro">Know your tax code?</span><br>
                        <label>Tax code (e.g. 1150L):<input size="6" maxlength="9" name="taxcode" value="" type="text" disabled></label>
                    </div>
                    <div id="tabs-2">
                        <span class="intro">Repaying your Student Loan?</span><br>
                        <label>Repayment Plan 1<input name="plan1" value="1" type="checkbox"></label><br>
                        <label>Repayment Plan 2<input name="plan2" value="1" type="checkbox"></label>
                    </div>
                    <!--
                    <div id="tabs-3">
                        <span class="intro">Getting a bonus in your pay?</span><br>
                        <label>Value of bonus: £<input size="6" maxlength="7" name="bonus" value="" type="number"></label><br>
                        <label>Pay period:<select name="payperiod" id="payperiod">
			            <option value="12" selected="selected">Monthly</option>
			            <option value="13">4-weekly</option>
			            <option value="26">2-weekly</option>
			            <option value="52">Weekly</option>
		                </select></label>
                    </div>
                    -->
                    <div id="tabs-4">
                        <span class="intro">Hours of overtime each month:</span><br>
                        <input size="2" name="otime1" value="" type="number">hours at
                        <input size="2" name="orate1" value="1.5" type="number">x normal rate
                        <br>
                        <input size="2" name="otime2" value="" type="number">hours at
                        <input size="2" name="orate2" value="2" type="number">x normal rate
                    </div>
                    <div id="tabs-5">
                        <span class="intro">Do you contribute to a pension?</span><br>
                        <div id="pensiontype">
                            <label id="pensionemployer" title="Occupational or employer's pension scheme"><input name="pensiontype" value="employer" checked="checked" type="radio">Employer</label>
                            <label id="pensionsacrifice" title="Salary sacrifice pension scheme where your salary is contractually reduced"><input name="pensiontype" value="sacrifice" type="radio">Salary sacrifice</label>
                            <label id="pensionpersonal" title="A personal or stakeholder pension scheme"><input name="pensiontype" value="personal" type="radio">Personal</label>
                        </div>
                        <div id="pensioninput">
                            <label>Pension:<input name="pension" size="2" maxlength="5" value="" type="number"></label>%
                            <label id="contractlabel">Contracted out:<input id="contractcheck" name="contract" value="1" checked="checked" type="checkbox"></label>
                        </div>
                    </div>
                    <div id="tabs-6">
                        <span class="intro">Monthly childcare vouchers:</span><br>
                        <label>Value of vouchers £<input name="childcare" size="2" maxlength="6" value="" type="number"></label>
                        <br>
                        <label>pre-6th April 2011:<input name="existingscheme" value="1" type="checkbox"></label>
                    </div>
                    <div id="tabs-7">
                        <span class="intro">Do you make a salary sacrifice?</span><br>
                        <label>Sacrifice amount £<input name="sacrifice" size="2" maxlength="6" value="" type="number"></label>
                        <br> Every
                        <label><input name="sacrificeperiod" value="1" type="radio">Year</label>
                        <label><input name="sacrificeperiod" value="12" checked="checked" type="radio">Month</label>
                        <label><input name="sacrificeperiod" value="52" type="radio">Week</label>
                    </div>
                    <div id="tabs-8">
                        <span class="intro">Any benefits in kind?</span><br>
                        <label>Taxable benefits £<input name="taxablebenefits" size="2" maxlength="6" value="" type="number"></label>
                        <br> Every
                        <label><input name="benefitperiod" value="1" type="radio">Year</label>
                        <label><input name="benefitperiod" value="12" checked="checked" type="radio">Month</label>
                        <label><input name="benefitperiod" value="52" type="radio">Week</label>
                    </div>
                    <div id="tabs-9">
                        <span class="intro">Other monthly deductions?</span><br>
                        <label>Gift Aid, charities, pre-tax <span class="deductionsinput">£<input name="pretax" size="2" maxlength="6" value="" type="number"></span></label>
                        <br>
                        <label>Deductions made after tax £<input name="posttax" size="2" maxlength="6" value="" type="number"></label>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" value="Submit">
            </form>
        </div>
        <div></div>
    </section>
    <section>
        <?php
        if (isset($_POST)) {
            //var_dump($_POST);
            require_once("assets/include.php");
        }
        ?>
            <table class="table-values">
                <tr>
                    <td>&nbsp;</td>
                    <td>Yearly</td>
                    <td>Monthly</td>
                    <td>Weekly</td>
                    <td>Daily</td>
                </tr>
                <tr>
                    <td class="row-title">Gross Income</td>
                    <td class="income-field">
                        <?php echo '&pound;' . $iYearlyGrossIncome; ?>
                    </td>
                    <td class="income-field">
                        <?php echo '&pound;' . round($iYearlyGrossIncome / 12, 2); ?>
                    </td>
                    <td class="income-field">
                        <?php echo '&pound;' . round($iYearlyGrossIncome / 52, 2); ?>
                    </td>
                    <td class="income-field">
                        <?php echo '&pound;' . round($iYearlyGrossIncome / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Pension Deductions</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyPensionDeduction; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPensionDeduction / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPensionDeduction / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPensionDeduction / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Childcare Vouchers</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyChildcareVoucher; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyChildcareVoucher / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyChildcareVoucher / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyChildcareVoucher / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Salary Sacrifice</td>
                    <td>
                        <?php echo '&pound;' . $iYearlySacrifice; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlySacrifice / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlySacrifice / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlySacrifice / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Taxable Benefits</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyTaxableBenefits; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTaxableBenefits / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTaxableBenefits / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTaxableBenefits / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Pre-tax deductions</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyPreTaxDeduction; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPreTaxDeduction / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPreTaxDeduction / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPreTaxDeduction / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Taxable Income</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyTaxableIncome; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTaxableIncome / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTaxableIncome / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTaxableIncome / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Tax</td>
                    <td>
                        <?php echo $iYearlyTax; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTax / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTax / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTax /52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">National Insurance</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyNI; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyNI / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyNI / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyNI / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Student Loan</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyStudentLoan; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyStudentLoan / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyStudentLoan / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyStudentLoan / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">Post-tax deductions</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyPostTaxDeduction; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPostTaxDeduction / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPostTaxDeduction / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyPostTaxDeduction / 52 / 5, 2); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row-title">2017 Take Home</td>
                    <td>
                        <?php echo '&pound;' . $iYearlyTakeHome; ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTakeHome / 12, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTakeHome / 52, 2); ?>
                    </td>
                    <td>
                        <?php echo '&pound;' . round($iYearlyTakeHome / 52 / 5, 2); ?>
                    </td>
                </tr>
            </table>
    </section>
    <!--Footer section-->
    <footer>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  See this data in a graph
</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Anual Take Home Graph</h4>
                    </div>
                    <div class="modal-body">
                        <div id="canvas-holder" style="width:70%">
                            <canvas id="chart-area" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div>
            </div>
        </div>

        <!--<div id="canvas-holder" style="width:40%">
            <canvas id="chart-area" />
        </div>-->

    </footer>
    <script>
        /*var myvar = <?php echo json_encode($aValues); ?>;
                                        console.log(myvar);*/
        /*var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };*/

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: <?php echo json_encode($aValues); ?>,
                    backgroundColor: <?php echo json_encode($aColors); ?>,
                    label: 'Dataset 1'
                }],
                labels: <?php echo json_encode($aLabels); ?>

            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'left'
                },
                /*tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            console.log(data.datasets[0].data[tooltipItem.index]);
                            /*console.log(tooltipItem);*/
                /*return "€";
                        }
                    }
                }*/
            }
        };

        window.onload = function() {
            var ctx = document.getElementById("chart-area").getContext("2d");
            window.myPie = new Chart(ctx, config);
        };

    </script>
</body>

</html>
