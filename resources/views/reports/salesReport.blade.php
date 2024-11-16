@extends('layouts.app')
@section('content')

<div class="container-fluid mt-5">
    <!-- فورم المبيعات -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Sales Form</h4>
            <!-- ضع هنا محتوى الفورم الخاص بالمبيعات -->
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <!-- الحقول الخاصة بالفورم هنا -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- رسم بياني -->
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Area Chart</h4>
            <canvas id="salesChart" style="height: 230px; width: 100%;"></canvas>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('salesChart');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Sales Data',
                    data: [120, 190, 300, 500, 200, 300, 400],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Sales'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    } else {
        console.error("Element with ID 'salesChart' not found.");
    }
});

</script>
@endsection
