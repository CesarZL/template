import './bootstrap';

// Import Chart.js
import { Chart } from 'chart.js';

// Import flatpickr
import flatpickr from 'flatpickr';
import { Spanish } from "flatpickr/dist/l10n/es.js"

// import component from './components/component';
import dashboardCard01 from './components/dashboard-card-01';
import dashboardCard02 from './components/dashboard-card-02';
import dashboardCard03 from './components/dashboard-card-03';
import dashboardCard04 from './components/dashboard-card-04';
import dashboardCard05 from './components/dashboard-card-05';
import dashboardCard06 from './components/dashboard-card-06';
import dashboardCard08 from './components/dashboard-card-08';
import dashboardCard09 from './components/dashboard-card-09';
import dashboardCard11 from './components/dashboard-card-11';

// Define Chart.js default settings
/* eslint-disable prefer-destructuring */
Chart.defaults.font.family = '"Inter", sans-serif';
Chart.defaults.font.weight = '500';
Chart.defaults.plugins.tooltip.borderWidth = 1;
Chart.defaults.plugins.tooltip.displayColors = false;
Chart.defaults.plugins.tooltip.mode = 'nearest';
Chart.defaults.plugins.tooltip.intersect = false;
Chart.defaults.plugins.tooltip.position = 'nearest';
Chart.defaults.plugins.tooltip.caretSize = 0;
Chart.defaults.plugins.tooltip.caretPadding = 20;
Chart.defaults.plugins.tooltip.cornerRadius = 4;
Chart.defaults.plugins.tooltip.padding = 8;

// Register Chart.js plugin to add a bg option for chart area
Chart.register({
  id: 'chartAreaPlugin',
  // eslint-disable-next-line object-shorthand
  beforeDraw: (chart) => {
    if (chart.config.options.chartArea && chart.config.options.chartArea.backgroundColor) {
      const ctx = chart.canvas.getContext('2d');
      const { chartArea } = chart;
      ctx.save();
      ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
      // eslint-disable-next-line max-len
      ctx.fillRect(chartArea.left, chartArea.top, chartArea.right - chartArea.left, chartArea.bottom - chartArea.top);
      ctx.restore();
    }
  },
});

document.addEventListener('DOMContentLoaded', () => {
  // Light switcher
  const lightSwitches = document.querySelectorAll('.light-switch');
  if (lightSwitches.length > 0) {
    lightSwitches.forEach((lightSwitch, i) => {
      if (localStorage.getItem('dark-mode') === 'true') {
        lightSwitch.checked = true;
      }
      lightSwitch.addEventListener('change', () => {
        const { checked } = lightSwitch;
        lightSwitches.forEach((el, n) => {
          if (n !== i) {
            el.checked = checked;
          }
        });
        document.documentElement.classList.add('[&_*]:!transition-none');
        if (lightSwitch.checked) {
          document.documentElement.classList.add('dark');
          document.querySelector('html').style.colorScheme = 'dark';
          localStorage.setItem('dark-mode', true);
          document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: 'on' } }));
        } else {
          document.documentElement.classList.remove('dark');
          document.querySelector('html').style.colorScheme = 'light';
          localStorage.setItem('dark-mode', false);
          document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: 'off' } }));
        }
        setTimeout(() => {
          document.documentElement.classList.remove('[&_*]:!transition-none');
        }, 1);
      });
    });
  }


  // Flatpickr
  flatpickr('.datepicker', {
    mode: 'single',
    static: true,
    monthSelectorType: 'static',
    maxDate: 'today',
    dateFormat: "Y-m-d",
    locale: Spanish,
  });

  // Flatpickr 2
  flatpickr('.datepicker2', {
    mode: 'single',
    static: true,
    monthSelectorType: 'static',
    dateFormat: "Y-m-d",
    minDate: 'today',
    locale: Spanish,
  });

  // busca todas las clases flatpickr-wrapper y agrega la clase w-full
  const flatpickrWrappers = document.querySelectorAll('.flatpickr-wrapper');
  if (flatpickrWrappers.length > 0) {
    flatpickrWrappers.forEach((flatpickrWrapper) => {
      flatpickrWrapper.classList.add('w-full');
    });
  }
    

  dashboardCard01();
  dashboardCard02();
  dashboardCard03();
  dashboardCard04();
  dashboardCard05();
  dashboardCard06();
  dashboardCard08();
  dashboardCard09();
  dashboardCard11();
});
