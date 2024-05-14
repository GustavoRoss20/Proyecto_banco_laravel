window.addEventListener('DOMContentLoaded', function() {
  const montoInput = document.getElementById('monto');
  const montoTotalInput = document.getElementById('montoTotal');

  montoInput.addEventListener('input', function() {
      const monto = parseFloat(this.value);

      if (!isNaN(monto) && monto >= 0) {
          const interes = monto * 0.25; // 25% de interés
          const montoTotal = monto + interes;
          montoTotalInput.value = montoTotal.toFixed(2);
      } else {
          montoTotalInput.value = ''; // Limpiar el campo de entrada del monto total
      }
  });
});