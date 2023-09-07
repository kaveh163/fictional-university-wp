// name of the our-blocks directory could be anything
// instead of wp.blockEditor.InnerBlocks use below for wordpress scripts package
// The InnerBlocks component lets us to click on the plus symbol in the block editor
// to start adding new blocks inside our block
// To restrict the blocks we can add to our block, use allowedBlocks prop in InnerBlock Component
import {
  InnerBlocks,
  useBlockProps,
  useInnerBlocksProps,
  useSetting,
} from "@wordpress/block-editor";
// first argument: namespace for all our blocks, and name for our specific block

wp.blocks.registerBlockType("ourblocktheme/banner", {
  apiVersion: 2,
  title: "Banner",
  attributes: {
    align: {
      type: "string",
      default: "full",
    },
    
  },

  supports: {
    align: ["full"],
    __experimentalLayout: {
      allowSwitching: false,
      default: {
        inherit: true,
      },
    },
  },
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent() {
  const blockProps = useBlockProps({ className: "page-banner" });
  const defaultLayout = useSetting("layout") || {};
  const useMeLater = (
    <>
      <h1 className="headline headline--large">Welcome!</h1>
      <h2 className="headline headline--medium">
        We think you&rsquo;ll like it here.
      </h2>
      <h3 className="headline headline--small">
        Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
        interested in?
      </h3>
      <a href="#" className="btn btn--large btn--blue">
        Find Your Major
      </a>
    </>
  );
  return (
    <div {...blockProps}>
      <div
        className="page-banner__bg-image"
        style={{
          backgroundImage:
            "url('/fictional-university/wp-content/themes/fictional-block-theme/images/library-hero.jpg')",
        }}
      ></div>
      <div className="page-banner__content container t-center c-white">
        <InnerBlocks allowedBlocks={["ourblocktheme/genericheading", "ourblocktheme/genericbutton"]} __experimentalLayout={defaultLayout} />
      </div>
    </div>
  );
}
// return content of SaveComponent will be saved in database
function SaveComponent() {
  // const blockProps = useBlockProps.save({ className: "page-banner" });
  // because the banner block can have blocks nested inside it, we do need to return this line below.
  return (
    <InnerBlocks.Content/>
  );
}
