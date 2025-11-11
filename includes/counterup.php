<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Simple Counters</title>
  <style>
    .row { display: flex; flex-wrap: wrap; gap: 16px; }
    .col {  flex: 1 1 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center; 
        }
    .title { margin-top: 8px; line-height: 1.2; color: #333; }
    .count { font-size: 1.6rem; font-weight: 700; margin-top: 8px; display: inline-block; }
    .gif { width: 100px; height: 100px; }
  </style>
</head>
<body>
    <div class="section-padding">

        <div class="row">
            <div class="col">
                <img class="gif" src="/assets/projects.gif" alt="Projects Icon">
                <div class="count" data-to="600">0</div>
                <div class="title">Projects<br>Completed</div>
            </div>
            
            <div class="col">
                <img class="gif" src="/assets/money.gif" alt="Revenue Icon">
                <div class="count" data-to="2082">0</div>
                <div class="title">Revenue<br>Generated ($)</div>
            </div>
            
            <div class="col">
                <img class="gif" src="/assets/tree.gif" alt="Tree Icon">
                <div class="count" data-to="3179">0</div>
                <div class="title">Trees<br>Planted</div>
            </div>
            
            <div class="col">
                <img class="gif" src="/assets/clients.gif" alt="Client Icon">
                <div class="count" data-to="60">0</div>
                <div class="title">Happy<br>Clients</div>
            </div>
        </div>
    </div>
  
  <script>
    function animateCount(el, duration = 1200) {
        const target = Number(el.dataset.to) || 0;
      const start = 0;
      const startTime = performance.now();

      function tick(now) {
        const progress = Math.min((now - startTime) / duration, 1);
        const value = Math.floor(start + (target - start) * progress);
        el.textContent = value.toLocaleString(); // adds commas if needed
        if (progress < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    }

    document.addEventListener('DOMContentLoaded', () => {
      const counters = document.querySelectorAll('.count');

      if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries, obs) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              animateCount(entry.target, 1200); // change duration for speed
              obs.unobserve(entry.target);
            }
          });
        }, { threshold: 0.5 });

        counters.forEach(el => io.observe(el));
      } else {
        counters.forEach(el => animateCount(el, 1200));
      }
    });
  </script>
</body>
</html>
