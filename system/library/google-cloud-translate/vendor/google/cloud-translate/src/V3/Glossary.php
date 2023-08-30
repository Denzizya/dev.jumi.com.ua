<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/translate/v3/translation_service.proto

namespace Google\Cloud\Translate\V3;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents a glossary built from user provided data.
 *
 * Generated from protobuf message <code>google.cloud.translation.v3.Glossary</code>
 */
class Glossary extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The resource name of the glossary. Glossary names have the form
     * `projects/{project-number-or-id}/locations/{location-id}/glossaries/{glossary-id}`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $name = '';
    /**
     * Required. Provides examples to build the glossary from.
     * Total glossary must not exceed 10M Unicode codepoints.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.GlossaryInputConfig input_config = 5;</code>
     */
    private $input_config = null;
    /**
     * Output only. The number of entries defined in the glossary.
     *
     * Generated from protobuf field <code>int32 entry_count = 6 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     */
    private $entry_count = 0;
    /**
     * Output only. When CreateGlossary was called.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp submit_time = 7 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     */
    private $submit_time = null;
    /**
     * Output only. When the glossary creation was finished.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 8 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     */
    private $end_time = null;
    protected $languages;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           Required. The resource name of the glossary. Glossary names have the form
     *           `projects/{project-number-or-id}/locations/{location-id}/glossaries/{glossary-id}`.
     *     @type \Google\Cloud\Translate\V3\Glossary\LanguageCodePair $language_pair
     *           Used with unidirectional glossaries.
     *     @type \Google\Cloud\Translate\V3\Glossary\LanguageCodesSet $language_codes_set
     *           Used with equivalent term set glossaries.
     *     @type \Google\Cloud\Translate\V3\GlossaryInputConfig $input_config
     *           Required. Provides examples to build the glossary from.
     *           Total glossary must not exceed 10M Unicode codepoints.
     *     @type int $entry_count
     *           Output only. The number of entries defined in the glossary.
     *     @type \Google\Protobuf\Timestamp $submit_time
     *           Output only. When CreateGlossary was called.
     *     @type \Google\Protobuf\Timestamp $end_time
     *           Output only. When the glossary creation was finished.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Translate\V3\TranslationService::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The resource name of the glossary. Glossary names have the form
     * `projects/{project-number-or-id}/locations/{location-id}/glossaries/{glossary-id}`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. The resource name of the glossary. Glossary names have the form
     * `projects/{project-number-or-id}/locations/{location-id}/glossaries/{glossary-id}`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Used with unidirectional glossaries.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.Glossary.LanguageCodePair language_pair = 3;</code>
     * @return \Google\Cloud\Translate\V3\Glossary\LanguageCodePair|null
     */
    public function getLanguagePair()
    {
        return $this->readOneof(3);
    }

    public function hasLanguagePair()
    {
        return $this->hasOneof(3);
    }

    /**
     * Used with unidirectional glossaries.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.Glossary.LanguageCodePair language_pair = 3;</code>
     * @param \Google\Cloud\Translate\V3\Glossary\LanguageCodePair $var
     * @return $this
     */
    public function setLanguagePair($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Translate\V3\Glossary\LanguageCodePair::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Used with equivalent term set glossaries.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.Glossary.LanguageCodesSet language_codes_set = 4;</code>
     * @return \Google\Cloud\Translate\V3\Glossary\LanguageCodesSet|null
     */
    public function getLanguageCodesSet()
    {
        return $this->readOneof(4);
    }

    public function hasLanguageCodesSet()
    {
        return $this->hasOneof(4);
    }

    /**
     * Used with equivalent term set glossaries.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.Glossary.LanguageCodesSet language_codes_set = 4;</code>
     * @param \Google\Cloud\Translate\V3\Glossary\LanguageCodesSet $var
     * @return $this
     */
    public function setLanguageCodesSet($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Translate\V3\Glossary\LanguageCodesSet::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Required. Provides examples to build the glossary from.
     * Total glossary must not exceed 10M Unicode codepoints.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.GlossaryInputConfig input_config = 5;</code>
     * @return \Google\Cloud\Translate\V3\GlossaryInputConfig|null
     */
    public function getInputConfig()
    {
        return $this->input_config;
    }

    public function hasInputConfig()
    {
        return isset($this->input_config);
    }

    public function clearInputConfig()
    {
        unset($this->input_config);
    }

    /**
     * Required. Provides examples to build the glossary from.
     * Total glossary must not exceed 10M Unicode codepoints.
     *
     * Generated from protobuf field <code>.google.cloud.translation.v3.GlossaryInputConfig input_config = 5;</code>
     * @param \Google\Cloud\Translate\V3\GlossaryInputConfig $var
     * @return $this
     */
    public function setInputConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Translate\V3\GlossaryInputConfig::class);
        $this->input_config = $var;

        return $this;
    }

    /**
     * Output only. The number of entries defined in the glossary.
     *
     * Generated from protobuf field <code>int32 entry_count = 6 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @return int
     */
    public function getEntryCount()
    {
        return $this->entry_count;
    }

    /**
     * Output only. The number of entries defined in the glossary.
     *
     * Generated from protobuf field <code>int32 entry_count = 6 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @param int $var
     * @return $this
     */
    public function setEntryCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->entry_count = $var;

        return $this;
    }

    /**
     * Output only. When CreateGlossary was called.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp submit_time = 7 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getSubmitTime()
    {
        return $this->submit_time;
    }

    public function hasSubmitTime()
    {
        return isset($this->submit_time);
    }

    public function clearSubmitTime()
    {
        unset($this->submit_time);
    }

    /**
     * Output only. When CreateGlossary was called.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp submit_time = 7 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setSubmitTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->submit_time = $var;

        return $this;
    }

    /**
     * Output only. When the glossary creation was finished.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 8 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    public function hasEndTime()
    {
        return isset($this->end_time);
    }

    public function clearEndTime()
    {
        unset($this->end_time);
    }

    /**
     * Output only. When the glossary creation was finished.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 8 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setEndTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->end_time = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguages()
    {
        return $this->whichOneof("languages");
    }

}

