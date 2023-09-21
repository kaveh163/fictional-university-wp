wp.blocks.registerBlockType("ourblocktheme/singlepost", {
  apiVersion: 2,
  title: "Fictional University Single Post",

  edit: function () {
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement(
      "div",
      { className: "our-placeholder-block" },
      "Single Post Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
