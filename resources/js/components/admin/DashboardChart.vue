<template>
    <div>
        <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="px-6 py-4">
            <h2 class="text-lg font-semibold mb-4">{{ chartTitle }}</h2>
            <div ref="chartContainer" class="h-96 w-full"></div> </div>
        </div>

        <div v-if="chartData.values.length > 0" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
        <div class="bg-indigo-100 p-4 rounded-xl text-center">
            <h3 class="text-sm font-bold text-gray-700">Periode Tertinggi</h3>
            <p class="text-xl font-semibold text-indigo-700">{{ highestPeriod.label }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-xl text-center">
            <h3 class="text-sm font-bold text-gray-700">Total Penjualan</h3>
            <p class="text-xl font-semibold text-green-700">{{ formattedTotal }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-xl text-center">
            <h3 class="text-sm font-bold text-gray-700">Rata-rata Penjualan</h3>
            <p class="text-xl font-semibold text-yellow-700">{{ formattedAverage }}</p>
        </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { ref, onMounted, onBeforeUnmount, watch, computed } from 'vue'
    import * as echarts from 'echarts'

    interface ChartData {
    labels: string[];
    values: number[];
    }
    const props = defineProps<{
    title?: string;
    chartData: ChartData;
    }>();
    const chartTitle = computed(() => props.title ?? 'Chart');
    const chartContainer = ref<HTMLElement | null>(null)
    let myChart: echarts.ECharts | null = null
   
    const totalSales = computed(() => props.chartData.values.reduce((sum, value) => sum + value, 0));
    const averageSales = computed(() => props.chartData.values.length === 0 ? 0 : totalSales.value / props.chartData.values.length);
    const formattedTotal = computed(() => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(totalSales.value));
    const formattedAverage = computed(() => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(averageSales.value));
    const highestPeriod = computed(() => {
    if (props.chartData.values.length === 0) return { label: 'N/A', value: 0 };
    const maxValue = Math.max(...props.chartData.values);
    const maxIndex = props.chartData.values.indexOf(maxValue);
    return {
        label: props.chartData.labels[maxIndex],
        value: maxValue,
    };
    });

    let resizeTimeout: ReturnType<typeof setTimeout>;

    // Fungsi resize yang sudah di-debounce
    const debouncedResize = () => {
    // Hapus timeout sebelumnya jika ada
    clearTimeout(resizeTimeout);
    // Set timeout baru
    resizeTimeout = setTimeout(() => {
        myChart?.resize();
    }, 150); // Tunggu 150 milidetik setelah user berhenti resize
    }

    onMounted(() => {
    if (chartContainer.value) {
        initChart()
        // Gunakan fungsi yang sudah di-debounce
        window.addEventListener('resize', debouncedResize)
    }
    })

    onBeforeUnmount(() => {
    if (myChart) {
        myChart.dispose()
    }
    // Hapus listener yang benar
    window.removeEventListener('resize', debouncedResize)
    clearTimeout(resizeTimeout); // Bersihkan timeout saat komponen hilang
    })

    const initChart = () => {

    if (!chartContainer.value) return;
    myChart = echarts.init(chartContainer.value, 'light', { renderer: 'svg' });
    myChart.setOption(getChartOptions());
    }

    const getChartOptions = (): echarts.EChartsOption => ({

    tooltip: {
        trigger: 'axis',
        axisPointer: { type: 'cross', label: { backgroundColor: '#6a7985' } },
        backgroundColor: 'rgba(255,255,255,0.9)',
        borderColor: '#ccc',
        borderWidth: 1,
        textStyle: { color: '#333' },
        formatter: (params: any) => {
            const param = params[0];
            const value = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(param.value);
            return `<b>${param.name}</b><br/>${param.marker} Sales: ${value}`;
        }
    },
    grid: { left: '2%', right: '3%', bottom: '15%', top: '15%', containLabel: true },
    xAxis: {
        type: 'category',
        data: props.chartData.labels,
        axisTick: { alignWithLabel: true },
        axisLabel: { interval: 'auto', rotate: 30 }
    },
    yAxis: {
        type: 'value',
        axisLabel: {
            formatter: (value: number) => {
                if (value >= 1000) return `${value / 1000}k`;
                return value.toString();
            }
        }
    },
    dataZoom: [{
        type: 'slider',
        start: 0,
        end: props.chartData.labels.length > 10 ? 50 : 100,
        bottom: 10,
        height: 20,
        dataBackground: { lineStyle: { color: '#4f46e5' }, areaStyle: { color: '#a5b4fc' } },
        fillerColor: 'rgba(79, 70, 229, 0.25)'
    }],
    series: [{
        name: 'Sales',
        type: 'bar',
        data: props.chartData.values,
        barMaxWidth: 50,
        showBackground: true,
        backgroundStyle: { color: 'rgba(180, 180, 180, 0.1)' },
        itemStyle: {
            borderRadius: [5, 5, 0, 0],
            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{ offset: 0, color: '#4338ca' },{ offset: 1, color: '#818cf8' }]),
            shadowColor: 'rgba(0, 0, 0, 0.3)',
            shadowBlur: 5,
        },
        emphasis: {
            focus: 'series',
            itemStyle: {
            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{ offset: 0, color: '#312e81' }, { offset: 1, color: '#4f46e5' }]),
            shadowBlur: 15
            }
        },
        animationEasing: 'elasticOut',
        animationDelay: (idx) => idx * 50,
    }],
    });

    watch(
    () => props.chartData,
    () => {
        myChart?.setOption(getChartOptions(), { notMerge: true });
    },
    { deep: true }
    );
</script>