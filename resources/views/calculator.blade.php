@extends('layouts.master')

@section('title', 'GPA Simulator & Calculator')

@section('content')


<div class="container mt-5">
    <h2>GPA Simulator</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Title</th>
                <th>Credit Hours</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody id="courseTable">
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course['code'] }}</td>
                <td>{{ $course['title'] }}</td>
                <td class="credits">{{ $course['credits'] }}</td>
                <td>
                    <input type="number" class="form-control grade" min="0" max="100">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-primary" onclick="calculateGPA()">Calculate GPA</button>
    <h3 class="mt-3">Your GPA: <span id="gpaResult">0.00</span></h3>

    <hr>

    <h2>Basic Calculator</h2>
    <div class="row">
        <div class="col-md-3">
            <input type="number" id="num1" class="form-control" placeholder="Enter first number">
        </div>
        <div class="col-md-3">
            <select id="operation" class="form-control">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" id="num2" class="form-control" placeholder="Enter second number">
        </div>
        <div class="col-md-3">
            <button class="btn btn-success" onclick="calculate()">Calculate</button>
        </div>
    </div>
    <h3 class="mt-3">Result: <span id="calcResult">0</span></h3>
</div>

<script>
    function calculateGPA() {
        let grades = document.querySelectorAll('.grade');
        let credits = document.querySelectorAll('.credits');
        let totalCredits = 0;
        let weightedSum = 0;

        for (let i = 0; i < grades.length; i++) {
            let grade = parseFloat(grades[i].value);
            let credit = parseFloat(credits[i].textContent);
            if (!isNaN(grade)) {
                weightedSum += grade * credit;
                totalCredits += credit;
            }
        }

        let gpa = totalCredits ? (weightedSum / totalCredits) / 25 : 0; // GPA scaled to 4.0
        document.getElementById('gpaResult').textContent = gpa.toFixed(2);
    }

    function calculate() {
        let num1 = parseFloat(document.getElementById('num1').value);
        let num2 = parseFloat(document.getElementById('num2').value);
        let operation = document.getElementById('operation').value;
        let result = 0;

        if (operation === '+') result = num1 + num2;
        else if (operation === '-') result = num1 - num2;
        else if (operation === '*') result = num1 * num2;
        else if (operation === '/' && num2 !== 0) result = num1 / num2;
        else result = "Error";

        document.getElementById('calcResult').textContent = result;
    }
</script>

@endsection
