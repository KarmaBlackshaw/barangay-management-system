
function showModal (ctx) {
  const attributeArray = Array.from(ctx.attributes)
    .filter(node => node.name.startsWith('data-value-'))

  const modal = ctx.attributes["data-target"].value
  const id = modal.replace(/#/g, '')

  attributeArray.forEach(attr => {
    const currModalAttr = `#${attr.name.replace('data-value', id)}`
    $(currModalAttr).val(attr.value)
  })

  $(modal).modal({
    show: true,
  })
}