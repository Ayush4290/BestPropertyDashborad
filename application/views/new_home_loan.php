<!-- Include Bootstrap and Chart.js -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.loanMain {
    padding: 50px 40px;
    background: linear-gradient(45deg, #d4ffde, #ffd3d7);
}
.loanMain form#loanForm {
    padding: 30px;
    background: white;
    margin: 0 20px;
    border-radius: 10px;
    box-shadow: 0 0 3px 0px #0000004f;
}
canvas#emiChart {
    padding: 30px;
    background: white;
    margin: 0 20px;
    border-radius: 10px;
    box-shadow: 0 0 3px 0px #00000026;
}
.results-container {
    padding: 30px;
    background: white;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0 0 3px 0px #00000026;
}
form#loanForm .form-group input, select, number {
    border: 1px solid #0000002b;
    border-radius: 0;
    outline: none;
    font-size: 17px;
    font-weight: 500;
    color: black;
}
form#loanForm .form-group label {
    color: #000;
    font-size: 19px;
    font-weight: 500;
    line-height: 22px;
    pointer-events: none;
    margin-bottom: 10px;
}
form#loanForm .form-group .range-slider-container span {
    font-weight: 500;
    font-size: 18px;
    color: black;
}
form#loanForm button#calculateBtn {
    border: none;
    background: #9f212a;
    padding: 10px;
    font-weight: 500;
    color: white;
    margin-left: -15px;
}
form#loanForm button#calculateBtn:hover {
    background: black;
    transition: all 0.5s ease;
}
.results-container h5 {
    font-size: 20px;
    font-weight: bold;
    color: black;
}
.results-container h5 span {
    font-weight: bold;
    color: #166534;
    padding-left: 10px;
}

    .form-label {
        font-weight: 600;
        color: #444;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 12px;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 5px rgba(78, 115, 223, 0.6);
    }

    .range-slider-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 5px;
    }

    .range-slider-container input[type="range"] {
        width: 80%;
        border-radius: 5px;
        background-color: #f1f1f1;
    }

    .range-slider-container span {
        font-size: 16px;
        color: #4e73df;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #2e59d9;
        padding: 12px 18px;
        border-radius: 10px;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #224abe;
    }

    /* Result area styling */
    /*.results-container {*/
    /*    margin-top: 30px;*/
    /*    padding: 25px;*/
    /*    background: #f9f9f9;*/
    /*    border-radius: 12px;*/
    /*    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);*/
    /*    border: 1px solid #e2e8f0;*/
    /*}*/

    .results-container h5 {
        margin: 10px 0;
        color: #333;
    }

    .results-container span {
        font-size: 18px;
        font-weight: 600;
        color: #4e73df;
    }


    .chart-container canvas {
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    /* Responsive layout */
    @media (max-width: 768px) {
        .col-md-6 {
            width: 100%;
        }
    }
</style>
<div class="loanMain">

<div class="container">
    <div class="row">
        <!-- Form Column -->   
        <div class="col-md-6">
            <form id="loanForm">
                <!-- Loan Amount -->
                <div class="form-group">
                    <label for="loan_amount" class="form-label">Loan Amount:</label>
                    <input type="number" id="loan_amount" name="loan_amount" class="form-control" required>
                    <div class="range-slider-container">
                        <span id="loan_amount_display">50000</span>
                        <input type="range" id="loan_amount_slider" min="50000" max="50000000" step="10000" value="50000">
                    </div>
                </div>

                <!-- Interest Rate -->
                <div class="form-group">
                    <label for="interest_rate" class="form-label">Interest Rate (% per annum):</label>
                    <input type="number" id="interest_rate" name="interest_rate" step="0.1" class="form-control" required>
                    <div class="range-slider-container">
                        <span id="interest_rate_display">1</span>
                        <input type="range" id="interest_rate_slider" min="1" max="36" step="0.1" value="1">
                    </div>
                </div>

                <!-- Loan Tenure -->
                <div class="form-group">
                    <label for="loan_tenure" class="form-label">Loan Tenure (years):</label>
                    <input type="number" id="loan_tenure" name="loan_tenure" class="form-control" required>
                    <div class="range-slider-container">
                        <span id="loan_tenure_display">1</span>
                        <input type="range" id="loan_tenure_slider" min="1" max="30" value="1">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-md-6 mt-3">
                    <button type="button" class="btn btn-primary w-100" id="calculateBtn">Calculate EMI</button>
                </div>
            </form>
        </div>


        <!-- Chart Column -->
        <div class="col-md-6 chart-container">
            <div style="width:400px !important; height:auto !important;">
            <canvas id="emiChart"></canvas>
            </div>
            <div class="results-container">
                <h5>Monthly EMI: <span id="emi_result">-</span></h5>
                <h5>Payable Amount: <span id="total_amount">-</span></h5>
                <h5>Interest Paid: <span id="total_interest">-</span></h5>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Elements for calculation and display
        const loanAmountSlider = document.getElementById("loan_amount_slider");
        const interestRateSlider = document.getElementById("interest_rate_slider");
        const loanTenureSlider = document.getElementById("loan_tenure_slider");

        const loanAmountInput = document.getElementById("loan_amount");
        const interestRateInput = document.getElementById("interest_rate");
        const loanTenureInput = document.getElementById("loan_tenure");

        const emiResult = document.getElementById("emi_result");
        const totalAmountResult = document.getElementById("total_amount");
        const totalInterestResult = document.getElementById("total_interest");

        const loanAmountDisplay = document.getElementById("loan_amount_display");
        const interestRateDisplay = document.getElementById("interest_rate_display");
        const loanTenureDisplay = document.getElementById("loan_tenure_display");

        const calculateBtn = document.getElementById("calculateBtn");

        // EMI Calculation function
        function calculateEMI(loanAmount, interestRate, tenure) {
            const monthlyInterestRate = (interestRate / 100) / 12;
            const numPayments = tenure * 12;
            const emi = (loanAmount * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, numPayments)) /
                (Math.pow(1 + monthlyInterestRate, numPayments) - 1);

            const totalAmount = emi * numPayments;
            const totalInterest = totalAmount - loanAmount;

            return { emi, totalAmount, totalInterest };
        }

        // Update results and chart
        function updateResults() {
            const loanAmount = parseFloat(loanAmountSlider.value);
            const interestRate = parseFloat(interestRateSlider.value);
            const tenure = parseFloat(loanTenureSlider.value);

            // Sync input fields with slider values
            loanAmountInput.value = loanAmount;
            interestRateInput.value = interestRate;
            loanTenureInput.value = tenure;

            loanAmountDisplay.textContent = loanAmount;
            interestRateDisplay.textContent = interestRate;
            loanTenureDisplay.textContent = tenure;

            const { emi, totalAmount, totalInterest } = calculateEMI(loanAmount, interestRate, tenure);

            emiResult.textContent = "₹ " + emi.toFixed(2);
            totalAmountResult.textContent = "₹ " + totalAmount.toLocaleString();
            totalInterestResult.textContent = "₹ " + totalInterest.toLocaleString();

            // Update chart data
            updateChart(emi, totalAmount, totalInterest);
        }

        // Chart.js initialization for Doughnut chart
        const ctx = document.getElementById("emiChart").getContext("2d");
        const emiChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Monthly EMI", "Total Payable Amount", "Total Interest Paid"],
                datasets: [{
                    label: "EMI Breakdown",
                    data: [0, 0, 0], // Initial values
                    backgroundColor: ["#007bff", "#28a745", "#ffc107"],
                    borderColor: ["#0056b3", "#218838", "#e0a800"],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "top"
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return "₹ " + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Update chart data
        function updateChart(emi, totalAmount, totalInterest) {
            emiChart.data.datasets[0].data = [emi, totalAmount, totalInterest];
            emiChart.update();
        }

        // Initialize results on page load
        updateResults();

        // Handle form calculations on button click
        calculateBtn.addEventListener("click", updateResults);

        // Event listeners for sliders
        loanAmountSlider.addEventListener("input", updateResults);
        interestRateSlider.addEventListener("input", updateResults);
        loanTenureSlider.addEventListener("input", updateResults);

        // Update input fields when sliders are changed
        loanAmountInput.addEventListener("input", function() {
            loanAmountSlider.value = loanAmountInput.value;
            updateResults();
        });

        interestRateInput.addEventListener("input", function() {
            interestRateSlider.value = interestRateInput.value;
            updateResults();
        });

        loanTenureInput.addEventListener("input", function() {
            loanTenureSlider.value = loanTenureInput.value;
            updateResults();
        });
    });
</script>
