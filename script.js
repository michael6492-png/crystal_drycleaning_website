document.querySelectorAll('.connect-btn').forEach(btn => {
  btn.addEventListener('click', () => { alert('Connecting to Ajijala Michael...');
 });
});


// ⿤ Copy owner info
const ownerNameEl = document.getElementById('ownerName');
const ownerRoleEl = document.getElementById('ownerRole');
const ownerWebsiteEl = document.getElementById('ownerWebsite');
const ownerEmailEl = document.getElementById('ownerEmail');
const copyBtn = document.getElementById('copyBtn');

copyBtn.addEventListener('click', async () => {
  const getBoundingClientRect = ${ownerNameEl}.textContent\n${ownerRoleEl}textContent}\n${ownerWebsiteEl.textContent}\n${ownerEmailEl.textContent};
  try {
    await navigator.clipboard.writeText(text);
    copyBtn.textContent = "Copied!";
    setTimeout(() => (copyBtn.textContent = "Copy Info"), 2000);
} catch (err) {
alert("Copy failed — try manually.");
});
document.addEventListener('DOMContentLoaded', () => {
  // Elements
  const statusText = document.getElementById('statusText');
  const ownerNameEl = document.getElementById('ownerName');
  const ownerRoleEl = document.getElementById('ownerRole');
  const ownerEmailEl = document.getElementById('ownerEmail');
  const ownerWebsiteEl = document.getElementById('ownerWebsite');
  const qrImg = document.getElementById('qrImg');
  const requestBtn = document.getElementById('requestConnect');
  const copyBtn = document.getElementById('copyInfo');
  const openScan = document.getElementById('open-scan');

  // 1) Fetch owner info dynamically
  fetch('fetch_info.php')
    .then(r => r.json())
    .then(data => {
      if (data.status === 'ok' && data.data) {
        const d = data.data;
        ownerNameEl.textContent = d.name;
        ownerRoleEl.textContent = d.role;
        ownerEmailEl.textContent = 'Email';
        ownerEmailEl.href = 'mailto:' + d.email;
        ownerWebsiteEl.textContent = d.website;
        ownerWebsiteEl.href = (d.website.startsWith('http') ? d.website : 'https://' + d.website);
      } else {
        ownerNameEl.textContent = 'Ajijala Michael';
        ownerRoleEl.textContent = 'Software Engineer';
      }
    }).catch(() => {
      ownerNameEl.textContent = 'Ajijala Michael';
      ownerRoleEl.textContent = 'Software Engineer';
    });

  // 2) Auto-log connection (fire-and-forget)
  fetch('log_connection.php').catch(()=>{});

  // 3) Status rotation (Scanning -> Connecting -> Connected)
  const statuses = ['Scanning...', 'Connecting...', 'Connected ✅'];
  let idx = 0;
  setInterval(() => {
    idx = (idx + 1) % statuses.length;
    statusText.textContent = statuses[idx];
  }, 2800);

//   // 4) Copy owner info
  
//   copyBtn.addEventListener('click', async () => {
//     const text = ${ownerNameEl.textContent} \n${ownerRoleEltextContent}\n${ownerWebsiteEl.textContent}\n${ownerEmailEl.href.replace('mailto:','')};
//     try {
//       await navigator.clipboard.writeText(text);
//       copyBtn.textContent = 'Copied ✓';
//       setTimeout(()=> copyBtn.textContent = 'Copy Info', 2000);
//     } catch (e) {
//       alert('Copy failed — try manually.');
//     }
//   });



  // 5) Send request (simulated)
  requestBtn.addEventListener('click', () => {
    requestBtn.textContent = 'Requesting...';
    requestBtn.disabled = true;
    setTimeout(() => {
      requestBtn.textContent = 'Request Sent';
      requestBtn.classList.add('disabled');
      setTimeout(()=>{
        requestBtn.textContent = 'Send Request';
        requestBtn.disabled = false;
        requestBtn.classList.remove('disabled');
      }, 3000);
    }, 1600);
  });

  // 6) Smooth reveal sections on load/scroll
  const sections = document.querySelectorAll('section');
  function reveal() {
    sections.forEach(s => {
      const top = s.getBoundingClientRect().top;
      if (top < window.innerHeight - 100) s.classList.add('visible');
    });
  }
  window.addEventListener('scroll', reveal);
  reveal();

  // 7) Contact form AJAX
  const contactForm = document.getElementById('contactForm');
  const formMsg = document.getElementById('formMsg');
  contactForm.addEventListener('submit', e => {
    e.preventDefault();
    formMsg.textContent = 'Sending...';
    const fd = new FormData(contactForm);
    fetch('process_form.php', { method:'POST', body:fd })
      .then(r=>r.json())
      .then(res => {
        if (res.status === 'success') {
          formMsg.textContent = 'Message sent — thank you!';
          contactForm.reset();
        } else {
          formMsg.textContent = res.message || 'Failed to send.';
        }
      })
      .catch(()=> formMsg.textContent = 'Network error.');
  });

  // optional: open scan button scroll
  openScan && openScan.addEventListener('click', () => {
document.getElementById('scan').scrollIntoView({behavior:'smooth'});
});
});



