wp.blocks.registerBlockType("ourblocktheme/programarchive", {
    apiVersion: 2,
    title: "Fictional University Program Archive",
  
    edit: function () {
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { className: "our-placeholder-block" },
        "Program Archive Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  