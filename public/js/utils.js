function fe(element, duration) {
  element.hide()
  element.fadeIn(500)
  setTimeout(() => {
    element.fadeOut(500)
  }, duration)
}

export { fe }