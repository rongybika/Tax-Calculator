<?php
if (isset($_POST['value'])) {
    $iYearlyGrossIncome = $_POST['value'];
} else {
    $iYearlyGrossIncome = 0;
}


//calculate bonus

//calculate Overtime
$iOverTimeNormal = 0;
$iOverTimeDouble = 0;

if (isset($_POST['otime1']) and !empty($_POST['otime1'])) {
    $iOverTimeNormal = ($iYearlyGrossIncome / (1650 + 300)) * intval($_POST['otime1']) * 1.5;
}
if (isset($_POST['otime2']) and !empty($_POST['otime2'])) {
    $iOverTimeDouble = ($iYearlyGrossIncome / (1650 + 300)) * intval($_POST['otime2']) * 2;
}
$iYearlyGrossIncome += round(($iOverTimeNormal * 12), 2) + round(($iOverTimeDouble * 12), 2);

/////////////////////////////////////////////////////////////////////////////////

//taxable income
$iYearlyTaxableIncome = $iYearlyGrossIncome;
//take home
$iYearlyTakeHome = $iYearlyGrossIncome;

$iTaxCode = 11500;

//calculate Personal Allowance by Salary
$iPersonalAllowance = 0;
if ($iYearlyGrossIncome < 100000) {
    $iPersonalAllowance = $iTaxCode;
}
if (($iYearlyGrossIncome >= 100000) and ($iYearlyGrossIncome <= 123000)) {
    $iYearlyGrossIncomeRest = $iYearlyGrossIncome - 100000;
    $iPersonalAllowance = $iTaxCode - ($iYearlyGrossIncomeRest / 2);
}
if ($iYearlyGrossIncome > 123000) {
    $iPersonalAllowance = 0;
}

$iYearlyTaxableIncome = round (($iYearlyTaxableIncome - $iPersonalAllowance), 2);

//////////////////////////////////////////////////////////////////////////////////

//calculate pension
$iYearlyPensionDeduction = 0;
if (isset($_POST['pension']) and (!empty($_POST['pension']))) {
    $iYearlyPensionValue = intval($_POST['pension']);
    
    $iYearlyPensionDeduction = round(($iYearlyGrossIncome * $iYearlyPensionValue) / 100, 2);
        
    $iYearlyTaxableIncome -= $iYearlyPensionDeduction;
    
    $iYearlyTakeHome -= $iYearlyPensionDeduction;
}

///////////////////////////////////////////////////////////////////////////////////

//calculate Childcare voucher
$iYearlyChildcareVoucher = 0;
if (isset($_POST['childcare']) and !empty($_POST['childcare'])) {
    $iYearlyChildcareVoucher += intval($_POST['childcare']) * 12;
    
    $iYearlyTakeHome -= $iYearlyChildcareVoucher;
}
if ($iYearlyChildcareVoucher <= 2916) {
    $iYearlyTaxableIncome -= $iYearlyChildcareVoucher;
    $iYearlyChildcareVoucherCalc = $iYearlyChildcareVoucher;
} else {
    $iYearlyTaxableIncome -= 2916;
    $iYearlyChildcareVoucherCalc = 2916;
}

$iYearlyChildcareVoucher = round($iYearlyChildcareVoucher, 2);

////////////////////////////////////////////////////////////////////////////////////

//check salary sacrifice
$iYearlySacrifice = 0;
if (isset($_POST['sacrifice']) and !empty($_POST['sacrifice'])) {
    if ($_POST['sacrificeperiod'] == '1') {
        $iYearlySacrifice = intval($_POST['sacrifice']);
    }
    
    if ($_POST['sacrificeperiod'] == '12') {
        $iYearlySacrifice = intval($_POST['sacrifice']) * 12;
    }
    
    if ($_POST['sacrificeperiod'] == '52') {
        $iYearlySacrifice = intval($_POST['sacrifice']) * 52;
    }
    
    $iYearlySacrifice = round($iYearlySacrifice, 2);
    
    $iYearlyTaxableIncome -= $iYearlySacrifice;
    
    $iYearlyTakeHome -= $iYearlySacrifice;
}

////////////////////////////////////////////////////////////////////////////////////

//taxable income
$iYearlyTaxableBenefits = 0;
if (isset($_POST['taxablebenefits']) and !empty($_POST['taxablebenefits']) and isset($_POST['benefitperiod'])) {
    if ($_POST['benefitperiod'] == '1') {
        $iYearlyTaxableBenefits = intval($_POST['taxablebenefits']);
    }
    
    if ($_POST['benefitperiod'] == '12') {
        $iYearlyTaxableBenefits = intval($_POST['taxablebenefits']) * 12;
    }
    
    if ($_POST['benefitperiod'] == '52') {
        $iYearlyTaxableBenefits = intval($_POST['taxablebenefits']) * 52;
    }
    
    $iYearlyTaxableBenefits = round($iYearlyTaxableBenefits, 2);
    $iYearlyTaxableIncome += $iYearlyTaxableBenefits;
}

///////////////////////////////////////////////////////////////////////////////////

//pre tax deduction
$iYearlyPreTaxDeduction = 0;
if (isset($_POST['pretax']) and !empty($_POST['pretax'])) {
    $iYearlyPreTaxDeduction = intval($_POST['pretax']) * 12;
    
    $iYearlyTaxableIncome -= $iYearlyPreTaxDeduction;
    $iYearlyTakeHome -= $iYearlyPreTaxDeduction;
}

//////////////////////////////////////////////////////////////////////////////////

//if Blind increase Personal Allowance by 2320
if (isset($_POST['blind']) and $_POST['blind'] === '1') {
    $iPersonalAllowance += 2320;
    $iYearlyTaxableIncome -= 2320;
}

//////////////////////////////////////////////////////////////////////////////////// 



////////////////////////////////////////////////////////////////////////////////////

//calculate tax
$iYearlyTax = 0;

if ($iYearlyGrossIncome < $iPersonalAllowance) {
    $iYearlyTax = 0;
}

if (($iYearlyGrossIncome > $iPersonalAllowance) and ($iYearlyGrossIncome < $iPersonalAllowance + 33500)) {
    $iYearlyTax = $iYearlyTaxableIncome * 0.20;
}
    
if (($iYearlyGrossIncome > $iPersonalAllowance + 33500) and ($iYearlyGrossIncome < 150000)) {
    $iYearlyTax = $iYearlyTaxableIncome * 0.40;
}    

if ($iYearlyGrossIncome > 150000) {
    $iYearlyTax = $iYearlyTaxableIncome * 0.45;
}

if ($iYearlyTaxableIncome <= 0) {
    $iYearlyTax = 0;
}

$iYearlyTax = round($iYearlyTax, 2);

$iYearlyTakeHome -= $iYearlyTax;

///////////////////////////////////////////////////////////////////////////////
//http://www.litrg.org.uk/tax-guides/pensioners-and-tax/what-tax-allowances-am-i-entitled
//married allowance
$iMarriedAllowance = 0;
$iMarriedAllowanceLowerLimit = 28000;
$iMarriedAllowanceHigherLimit = 38370;
$iMinimumMCA = 3260;
$iMaximumMCA = 8445;

if (isset($_POST['married']) and $_POST['age'] == 'above79') {
    if ($iYearlyGrossIncome < $iMarriedAllowanceLowerLimit) {
        $iMarriedAllowance = $iMaximumMCA * 0.10;
    }

    if ($iYearlyGrossIncome > $iMarriedAllowanceLowerLimit and $iYearlyGrossIncome < $iMarriedAllowanceHigherLimit) {
    $iDifference = $iYearlyGrossIncome - $iMarriedAllowanceLowerLimit;
    $iRestriction = $iDifference / 2;
    $iMarriedAllowance = ($iMaximumMCA - $iRestriction) * 0.10;
    }
    
    if ($iYearlyGrossIncome > $iMarriedAllowanceHigherLimit) {
        $iMarriedAllowance = $iMinimumMCA * 0.10;
    }
    
    $iYearlyTax -= $iMarriedAllowance;
    $iYearlyTakeHome += $iMarriedAllowance;
    echo 'maried';
    echo $iMarriedAllowance;
}

///////////////////////////////////////////////////////////////////////////////

//calculate National Insurance
$iYearlyNI = 0;
$checkSum = ($iYearlyGrossIncome / 52) - ($iYearlyChildcareVoucherCalc / 52) - ($iYearlySacrifice / 52);

if ($checkSum <= 157) {
    $iYearlyNI = 0;
    echo 'first';
}
if ($checkSum > 157 and $checkSum <= 866) {
    $iYearlyNI += (($checkSum - 157) * 52) * 0.12;
}
if ($checkSum > 866) {
    $iYearlyNI += ((709 - ($iYearlyChildcareVoucherCalc / 52) - ($iYearlySacrifice / 52)) * 52) * 0.12;
    
    $iYearlyNI += (($checkSum - 866) * 52) * 0.02;
}

if ($iYearlyTaxableIncome < 0 and $iYearlyPreTaxDeduction == 0) {
    $iYearlyNI = 0;
    echo 'second';
}

//check if by age have NI
if (isset($_POST['age']) and ($_POST['age'] == '6978' or $_POST['age'] == 'above79')) {
    $iYearlyNI = 0;
}

//check if have NI
if (isset($_POST['NIcheck']) and ($_POST['NIcheck'] == '1')) {
    $iYearlyNI = 0;
}

$iYearlyNI = round($iYearlyNI, 2);

$iYearlyTakeHome -= round($iYearlyNI, 2);

////////////////////////////////////////////////////////////////////////////////////////////
    
//calculate Student Loan
$iYearlyStudentLoan = 0;

$iPlan1YearlyThreshold = 17775;

$iPlan2YearlyThreshold = 21000;

$iYearlyStudentLoanBasePlan1 = $iYearlyGrossIncome - $iPlan1YearlyThreshold - $iYearlyChildcareVoucherCalc;

if ($iYearlyGrossIncome > $iPlan1YearlyThreshold) {
    if (isset($_POST['plan1']) and empty($_POST['plan2'])) {
        $iYearlyStudentLoan += $iYearlyStudentLoanBasePlan1 * 0.09;   
    }
}

$iYearlyStudentLoanBasePlan2 = $iYearlyGrossIncome - $iPlan2YearlyThreshold - $iYearlyChildcareVoucherCalc;

if ($iYearlyGrossIncome > $iPlan2YearlyThreshold) {
    if (isset($_POST['plan2']) and empty($_POST['plan1'])) {
        $iYearlyStudentLoan += $iYearlyStudentLoanBasePlan2 * 0.09;   
    }
    
    if (isset($_POST['plan1']) and isset($_POST['plan2'])) {
        if ($iYearlyGrossIncome < $iPlan2YearlyThreshold) {
        }
        else {
            $iYearlyStudentLoan += ($iPlan2YearlyThreshold - $iPlan1YearlyThreshold) * 0.09;
            
            $iYearlyStudentLoan += $iYearlyStudentLoanBasePlan2 * 0.09;   
        }
    }
}

$iYearlyStudentLoan = round($iYearlyStudentLoan, 2);

$iYearlyTakeHome -= $iYearlyStudentLoan;

///////////////////////////////////////////////////////////////////////////////////////////

//post tax deduction
$iYearlyPostTaxDeduction = 0;

if (isset($_POST['posttax']) and !empty($_POST['posttax'])) {
    $iYearlyPostTaxDeduction = intval($_POST['posttax']) * 12;
    
    $iYearlyTakeHome -= $iYearlyPostTaxDeduction;
}

//////////////////////////////////////////////////////////////////////////////////////////
    
//round taxable income
if ($iYearlyTaxableIncome > 0) {
    $iYearlyTaxableIncome = round ($iYearlyTaxableIncome, 2);
} else {
    $iYearlyTaxableIncome = 0;
}

//round take home
$iYearlyTakeHome = round($iYearlyTakeHome, 2);

//////////////////////////////////////////////////////////////////////////////////////////
//push into array values, labels, colors
$aValues = array();
$aLabels = array();
$aColors = array();

if ($iYearlyPensionDeduction != 0) {
    array_push($aValues, $iYearlyPensionDeduction);
    array_push($aLabels, 'Pension Deduction');
    array_push($aColors, 'rgb(255, 99, 132)');
}

if ($iYearlyPensionDeduction != 0) {
    array_push($aValues, $iYearlyChildcareVoucher);
    array_push($aLabels, 'Childcare Vouchers');
    array_push($aColors, 'rgb(255, 159, 64)');
};

if ($iYearlyPensionDeduction != 0) {
    array_push($aValues, $iYearlySacrifice);
    array_push($aLabels, 'Salary Sacrifice');
    array_push($aColors, 'rgb(255, 205, 86)');
};

if ($iYearlyTaxableBenefits != 0) {
    array_push($aValues, $iYearlyTaxableBenefits);
    array_push($aLabels, 'Taxable Benefits');
    array_push($aColors, 'rgb(75, 192, 192)');
};

if ($iYearlyPreTaxDeduction != 0) {
    array_push($aValues, $iYearlyPreTaxDeduction);
    array_push($aLabels, 'Pre-tax Deduction');
    array_push($aColors, 'rgb(54, 162, 235)');
};

if ($iYearlyTaxableIncome != 0) {
    array_push($aValues, $iYearlyTaxableIncome);
    array_push($aLabels, 'Taxable Income');
    array_push($aColors, 'rgb(153, 102, 255)');
};

if ($iYearlyTax != 0) {
    array_push($aValues, $iYearlyTax);
    array_push($aLabels, 'Tax');
    array_push($aColors, 'rgb(201, 203, 207)');
};

if ($iYearlyNI != 0) {
    array_push($aValues, $iYearlyNI);
    array_push($aLabels, 'National Insurance');
    array_push($aColors, 'rgb(99, 255, 255)');
};

if ($iYearlyStudentLoan != 0) {
    array_push($aValues, $iYearlyStudentLoan);
    array_push($aLabels, 'Student Loan');
    array_push($aColors, 'rgb(255, 185, 99)');
};

if ($iYearlyPostTaxDeduction != 0) {
    array_push($aValues, $iYearlyPostTaxDeduction);
    array_push($aLabels, 'Post-tax Deduction');
    array_push($aColors, 'rgb(255, 122, 99)');
};

if ($iYearlyTakeHome != 0) {
    array_push($aValues, $iYearlyTakeHome);
    array_push($aLabels, 'Take Home');
    array_push($aColors, 'rgb(177, 255, 99)');
};

?>
