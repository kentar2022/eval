function filterAds() {
  const minPrice = parseInt(document.getElementById('minPrice').value);
  const maxMileage = parseInt(document.getElementById('maxMileage').value);
  const minYear = parseInt(document.getElementById('minYear').value);
  const carBrand = document.getElementById('carBrand').value.toLowerCase();

  const ads = document.getElementsByClassName('ad');

  for (let ad of ads) {
    const price = parseInt(ad.getAttribute('data-price'));
    const mileage = parseInt(ad.getAttribute('data-mileage'));
    const year = parseInt(ad.getAttribute('data-year'));
    const brand = ad.getAttribute('data-brand').toLowerCase();

    const showAd =
      (isNaN(minPrice) || price >= minPrice) &&
      (isNaN(maxMileage) || mileage <= maxMileage) &&
      (isNaN(minYear) || year >= minYear) &&
      (carBrand === '' || brand.includes(carBrand));

    ad.style.display = showAd ? 'block' : 'none';
  }
}

