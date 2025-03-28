@extends('Layouts.StudentsLayout') 
@section('content')
<div class="flex justify-center items-center h-screen relative  w-full  mt-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full max-w-screen-lg ">
        <!-- First Column -->
        <div class="w-full">
            <div class="max-w-sm w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between mb-3">
                    <div class="flex justify-center items-center">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Module Grade Comparison</h5>
                        <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                        </svg>
                        <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3>
                                <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                                <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                                <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg></a>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                    <div>
                    
                    </div>
                </div>
                <div>
                    <div class="flex" id="devices">
                      <div class="flex items-center me-4">
                          <p  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" id="max_note">Max moyenne: 16</p>
                      </div>
                      <div class="flex items-center me-4">
                        <p  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" id="min_note">Min moyenne: 16</p>

                      </div>
                     
                    </div>
                </div>
                <p id="loading-message">Loading ...</p>
                <div class="py-6 text-white" id="donut-chart"></div>
            </div>
        </div>

        <!-- Second Column -->
        <div class="w-full">
            <!-- Title for the section -->
            {{-- <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Moyenne par module</h2> --}}
            <div class="relative overflow-x-auto ">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                      <tr>
                          <th scope="col" class="px-6 py-3">
                              Exame
                          </th>
                          <th scope="col" class="px-6 py-3">
                              Note
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($recordes as $recored)
                    <tr class="bg-white dark:bg-gray-800">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$recored->exames->name}}
                      </th>
                    
                      <td class="px-6 py-4">
                        {{$recored->note}}
                      </td>
                    
                  </tr>
                    @endforeach
                    
                  </tbody>
              </table>
            </div>
            
            <!-- Grid for notes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" id="notes">
                <figure class="flex flex-col items-center justify-center p-4 text-center bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-full max-w-xs mx-auto">
                    <blockquote class="max-w-xs mx-auto mb-2 text-gray-500 dark:text-gray-400">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white"></h3>
                        <p class="my-2 text-sm"></p>
                    </blockquote>
                </figure>
                <figure class="flex flex-col items-center justify-center p-4 text-center bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-full max-w-xs mx-auto">
                    <blockquote class="max-w-xs mx-auto mb-2 text-gray-500 dark:text-gray-400">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white"></h3>
                        <p class="my-2 text-sm"></p>
                    </blockquote>
                </figure>
                <figure class="flex flex-col items-center justify-center p-4 text-center bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-full max-w-xs mx-auto">
                    <blockquote class="max-w-xs mx-auto mb-2 text-gray-500 dark:text-gray-400">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white"></h3>
                        <p class="my-2 text-sm"></p>
                    </blockquote>
                </figure>
                <figure class="flex flex-col items-center justify-center p-4 text-center bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-full max-w-xs mx-auto">
                    <blockquote class="max-w-xs mx-auto mb-2 text-gray-500 dark:text-gray-400">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white"></h3>
                        <p class="my-2 text-sm"></p>
                    </blockquote>
                </figure>
            </div>
            <div class="">
              


            </div>
        </div>
        
    </div>
    
</div>

<script>


let pre = [18.2, 16, 12, 16];
    let total = pre.reduce((sum, num) => sum + num, 0);
    let percentages = pre.map(num => (num / total) * 100).map(num => Number(num.toFixed(0)));
    console.log("per", percentages); 
  let idUser = {{auth()->user()->id}}
  
const getData = async() =>{
    const responce =  await fetch('/recordsStats/${idUser}')
    const data = await responce.json()
    let  info = data.map((ob) => ob.weighted_avg_note);
     let total = info.reduce((sum, num) => sum + num, 0);

    let percentages = info.map(num => (num / total) * 100).map(num => Number(num.toFixed(0)));
    const max = data.reduce((max , c)=> max.weighted_avg_note > c.weighted_avg_note ? max : c, data[0] )  
    const min = data.reduce((min , c)=> min.weighted_avg_note < c.weighted_avg_note ? min : c, data[0] )  
    const minP = document.getElementById("min_note");
    const maxP = document.getElementById("max_note");
    minP.textContent = "Max moyenne: " + min.weighted_avg_note;
    maxP.textContent ="Min moyenne: " +  max.weighted_avg_note;
    console.log(max);
    console.log(min);
    console.log(percentages);
    return percentages
    // console.log(info);
    return info
} 

const getNames = async() =>{
    const responce =  await fetch('/recordsStats/${idUser}')
    const data = await responce.json()
    let  info = data.map((ob) => ob.name);
    console.log(info);
    return info
} 
const Maxes = async () => {
    try {
        const response = await  fetch('/recordsStats/${idUser}') // Fetch data from the API
        const data = await response.json(); // Parse the JSON response
        const notes = document.getElementById("notes"); // Get the notes container
        console.log("dd",data);
        // Clear existing content (optional, if you want to refresh the grid)
        notes.innerHTML = '';

        // Loop through the data and create a new note for each item
        for (let i = 0; i < data.length; i++) {
            const note = document.createElement("figure"); // Create a new figure element
            note.className = "flex flex-col items-center justify-center p-4 text-center bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-full max-w-xs mx-auto";

            // Create the blockquote element
            const blockquote = document.createElement("blockquote");
            blockquote.className = "max-w-xs mx-auto mb-2 text-gray-500 dark:text-gray-400";

            // Create the heading (h3) for the note title
            const title = document.createElement("h3");
            title.className = "text-base font-semibold text-gray-900 dark:text-white";
            title.textContent = data[i].name || "No title"; // Use the title from the data or a fallback

            // Create the paragraph (p) for the note content
            const content = document.createElement("p");
            content.className = "my-2 text-sm";
            content.textContent = data[i].weighted_avg_note + "/20" || "No note"; // Use the content from the data or a fallback

            // Append the title and content to the blockquote
            blockquote.appendChild(title);
            blockquote.appendChild(content);

            // Append the blockquote to the figure
            note.appendChild(blockquote);

            // Append the figure to the notes grid
            notes.appendChild(note);
        }
    } catch (error) {
        console.error("Error fetching or processing data:", error);
    }
};

// Call the function to execute it
Maxes();
getData() 
getNames()
const getChartOptions =async () => {
  return {
    series: await getData(),
    colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"],
    chart: {
      height: 320,
      width: "100%",
      type: "donut",
      foreColor: "#FFFFFF", // Set default text color to white

    },
    stroke: {
      colors: ["transparent"],
      lineCap: "",
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            name: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: 20,
            },
            total: {
              showAlways: true,
              show: true,
              label: "",
              fontFamily: "Inter, sans-serif",
              color: "#FFFFFF", // Ensure total label is white
              formatter: function (w) {
                const sum = w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
                return"Grade Comparison"
              },
            },
            value: {
              show: true,
              fontFamily: "Inter, sans-serif",
              color: "#FFFFFF", // Ensure value labels are white
              offsetY: -20,
              formatter: function (value) {
                return value + "k"
              },
            },
          },
          size: "80%",
        },
      },
    },
    grid: {
      padding: {
        top: -2,
      },
    },
    labels: await getNames(),
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return value + "%"
        },
      },
    },
    xaxis: {
      labels: {
        formatter: function (value) {
          return value + "k";
        },
        style: {
          colors: "#FFFFFF", // Ensure x-axis labels are white
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
  }
}

if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {

const loadChart = async () => {
  const options = await getChartOptions();
  const chart = new ApexCharts(document.querySelector("#donut-chart"), options);
  chart.render();
};

loadChart(); // Call function to load chart after data is fetched

}

const loadChart = async () => {
  const loadingMessage = document.getElementById("loading-message");
  const chartContainer = document.getElementById("donut-chart");

  // Show loading message, hide the chart
  loadingMessage.style.display = "block";
  chartContainer.style.display = "none";

  try {
    const options = await getChartOptions();
    const chart = new ApexCharts(chartContainer, options);
    chart.render();

    // Hide loading message, show the chart
    loadingMessage.style.display = "none";
    chartContainer.style.display = "block";
  } catch (error) {
    loadingMessage.textContent = "Failed to load chart.";
    console.error("Error loading chart:", error);
  }
};

loadChart();


</script>
<style>
    #loading-message {
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  margin-top: 20px;
}

</style>


@endsection