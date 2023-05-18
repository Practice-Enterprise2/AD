{{-- -*-html-*- --}}

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Payslip</title>
  <link rel="stylesheet" href="css/payslip.css">
</head>

<body>
  <div>
    <p>
      Blue Sky Unlimited</br>
      Place Jourdan 1</br>
      Brussels/Bruxelles
    </p>
    <hr>
    <p>
      <b>Pay Date:</b> {{ $payDate }}
    </p>
  </div>
  <div>
    <div class="discription">
      <h3>Discription</h3>
      <p>
        Days worked</br>
        Hours worked</br>
        <hr>
      </p>
      <h4>Absences</h4>
      <p>
        Paid holidays</br>
        Unpaid holidays</br>
        <hr>
      </p>
      <p>
        Paid sickdays</br>
        Unpaid sickdays
      </p>
    </div>
    <div class="amount">
      <h3>Amount</h3>
      <p>
        {{ $workingDays }}</br>
        {{ $workingHours }}</br>
        <hr>
      </p>
      <h4 style="color: lightgray;">Absences</h4>
      <p>
        {{ $paidHolidays }}</br>
        {{ $unpaidHolidays }}</br>
        <hr>
      </p>
      <p>
        {{ $paidSickdays }}</br>
        {{ $unpaidSickdays }}
      </p>
      </p>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div>
    <div class="discription">
      <h3>Discription</h3>
      <p>
        Wage</br>
        Unpaid absence</br></br>
        Gross salary subject to nss</br>
        nss (National Social Security)</br>
        <hr></br>
        Taxable income</br>
        Tax withholdings</br>
        <hr></br>
        Net Earnings
      </p>
    </div>
    <div class="amount">
      <h3>Amount</h3>
      <p>
        ${{ $wage }}</br>
        -${{ $unpaidAbsence }}</br></br>
        ${{ $grossSalary }}</br>
        -${{ $nss }}</br>
        <hr></br>
        ${{ $taxableIncome }}</br>
        -${{ $taxes }}</br>
        <hr></br>
        ${{ $netEarnings }}
      </p>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div class="summary">
    <h3>Summary</h3>
    <p><b>Primary Bank Account</b></p>
    <p class="iban">{{ $IBAN }}</p>
    <p class="earnings">${{ $netEarnings }}</p>
  </div>
</body>

</html>
