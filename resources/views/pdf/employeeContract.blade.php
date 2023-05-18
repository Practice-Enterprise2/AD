<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>EmployeeContract</title>
  </head>
  <body>
@if(@isset($data))
        <div class="border-solid border-2 border-black h-[1000px] w-[600px] mt-10 mx-auto">
                <div class="border-solid border-2 border-black m-5">
                    <h1 class="text-center text-red-600 text-xl">BlueSky</h1>
                    <h1 class="text-center text-red-600 text-xl">Employee Contract</h1>
                </div>
                <div class="border-solid border-2 border-black m-5 p-5">
                    <h2 class="text-center text-sm">Employee Contract</h2><br>
                    <p class="text-center text-sm">Start date: {{$data["startdate"]}}</p>
                    <p class="text-center text-sm">Stop date: {{$data["stopdate"]}}</p>
                    <br>
                    <p class="text-sm">
                    THIS AGREEMENT made as of {{$data['created_at']}}, between
                    BlueSky a corporation incorporated under laws and {{$data['last_name']}} {{$data['name']}}.
                    having its principal place of business in Belgium and other parts in the world.
                    </p>
                    <br>
                    <p class="text-sm">WHEREAS the Employer desires to obtain the benefit of the services of the Employee, and the
Employee desires to render such services on the terms and conditions set forth.</p>
                    <br>
<p class="text-sm">IN CONSIDERATION of the promises and other good and valuable consideration (the
sufficiency and receipt of which are hereby acknowledged) the parties agree as follows:
1. Employment
The Employee agrees that he will at all times faithfully, industriously, and to the best of his skill,
ability, experience and talents, perform all of the duties required of his position. In In carrying out
these duties and responsibilities, the Employee shall comply with all Employer policies,
procedures, rules and regulations, both written and oral, as are announced by the Employer from
time to time. It is also understood and agreed to by the Employee that his assignment, duties and
responsibilities and reporting arrangements may be changed by the Employer in its sole
discretion without causing termination of this agreement.</p>
<br>
<p class="text-sm">2. Position Title
the Employee is required to perform the following duties and undertake
As a {{$data["position"]}}
to
the following responsibilities in a professional manner</p>
<br>
<p class="text-sm">3.
Compensation
As full compensation for all services provided the employee shall be paid at the rate of {{$data['salary']}} Euro per month
Such payments shall be subject to such normal statutory deductions by the 
of
Employer.</p>
                </div>

        </div>

    @endif
  </body>