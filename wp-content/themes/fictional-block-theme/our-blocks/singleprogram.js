wp.blocks.registerBlockType("ourblocktheme/singleprogram", {
    apiVersion: 2,
    title: "Fictional University Single Program",
  
    edit: function () {
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { className: "our-placeholder-block" },
        "Single Program Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  