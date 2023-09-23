wp.blocks.registerBlockType("ourblocktheme/footer", {
  apiVersion: 2,
  title: "Fictional University Footer",

  edit: function () {
    const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement(
      "div",
      { ...blockProps },
      "Footer Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
