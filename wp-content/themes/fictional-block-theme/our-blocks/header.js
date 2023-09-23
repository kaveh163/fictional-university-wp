wp.blocks.registerBlockType("ourblocktheme/header", {
  apiVersion: 2,
  title: "Fictional University Header",

  edit: function () {
    const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement(
      "div",
      { ...blockProps },
      "Header Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
