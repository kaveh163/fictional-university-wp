wp.blocks.registerBlockType("ourblocktheme/header", {
  apiVersion: 2,
  title: "Fictional University Header",

  edit: function () {
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement(
      "div",
      { className: "our-placeholder-block" },
      "Header Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
