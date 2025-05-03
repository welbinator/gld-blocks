import { useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Button, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const {
    siorTitle,
    siorVideoUrl,
    siorText,
    siorLogo,
    ccimTitle,
    ccimText,
    ccimLogo,
    teamMembers,
  } = attributes;

  const updateTeamMember = (index, field, value) => {
    const updated = [...teamMembers];
    updated[index][field] = value;
    setAttributes({ teamMembers: updated });
  };

  const blockProps = useBlockProps();

  return (
    <div {...blockProps}>
      <section className="mb-16">
        <RichText
          tagName="h2"
          className="text-3xl font-semibold text-red-600 mb-8 font-montserrat"
          value={siorTitle}
          onChange={(val) => setAttributes({ siorTitle: val })}
          placeholder="Why hire a SIOR?"
        />
        <TextControl
          label="YouTube Embed URL"
          value={siorVideoUrl}
          onChange={(val) => setAttributes({ siorVideoUrl: val })}
        />
        <div className="relative mb-10">
          <iframe
            src={siorVideoUrl}
            title="SIOR Video"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowFullScreen
            className="absolute top-0 left-0 w-full h-full rounded-lg"
          />
        </div>
        <RichText
          tagName="div"
          className="sior-text prose prose-lg max-w-none mb-8"
          value={siorText}
          onChange={(val) => setAttributes({ siorText: val })}
          placeholder="Add SIOR description text here..."
        />
        <MediaUploadCheck>
          <MediaUpload
            onSelect={(media) => setAttributes({ siorLogo: media.url })}
            allowedTypes={['image']}
            render={({ open }) => (
              <div className="max-w-xs mb-12">
                <img src={siorLogo} alt="SIOR Logo" className="h-auto mb-2" />
                <Button onClick={open} variant="secondary">Change SIOR Logo</Button>
              </div>
            )}
          />
        </MediaUploadCheck>
      </section>

      <section className="mb-16">
        <RichText
          tagName="h2"
          className="text-3xl font-semibold text-red-600 mb-8 font-montserrat"
          value={ccimTitle}
          onChange={(val) => setAttributes({ ccimTitle: val })}
          placeholder="Why hire a CCIM?"
        />
        <RichText
          tagName="div"
          className="ccim-text prose prose-lg max-w-none mb-8"
          value={ccimText}
          onChange={(val) => setAttributes({ ccimText: val })}
          placeholder="Add CCIM description text here..."
        />
        <MediaUploadCheck>
          <MediaUpload
            onSelect={(media) => setAttributes({ ccimLogo: media.url })}
            allowedTypes={['image']}
            render={({ open }) => (
              <div className="max-w-xs mb-12">
                <img src={ccimLogo} alt="CCIM Logo" className="h-auto mb-2" />
                <Button onClick={open} variant="secondary">Change CCIM Logo</Button>
              </div>
            )}
          />
        </MediaUploadCheck>
      </section>

      <section>
        <h2 className="text-3xl font-semibold text-red-600 mb-8 font-montserrat">GLD Designees</h2>
        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8">
          {teamMembers.map((member, i) => (
            <div className="text-center" key={i}>
              <MediaUploadCheck>
                <MediaUpload
                  onSelect={(media) => updateTeamMember(i, 'image', media.url)}
                  allowedTypes={['image']}
                  render={({ open }) => (
                    <div
                      className="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full cursor-pointer"
                      onClick={open}
                    >
                      <img src={member.image} alt={member.name || 'Team Member'} className="object-cover w-full h-full" />
                    </div>
                  )}
                />
              </MediaUploadCheck>
              <RichText
                tagName="h3"
                className="font-semibold"
                value={member.name}
                onChange={(val) => updateTeamMember(i, 'name', val)}
                placeholder="Team member name"
              />
              <RichText
                tagName="p"
                className="text-sm text-gray-600"
                value={member.title}
                onChange={(val) => updateTeamMember(i, 'title', val)}
                placeholder="Team member title"
              />
            </div>
          ))}
        </div>
      </section>
    </div>
  );
}
