function hideShowContent() {
  var loadingOverlay = document.getElementById('loading-overlay-site');
  var siteContent = document.getElementById('mysite-content');

  loadingOverlay.style.display = 'none';
  siteContent.style.display = 'block';
}

window.addEventListener('load', hideShowContent);