wp.blocks.registerBlockType("ourblocktheme/singlepost", {
  apiVersion: 2,
  title: "Fictional University Single Post",

  edit: function () {
    const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement(
      "div",
      { ...blockProps },
      "Single Post Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
