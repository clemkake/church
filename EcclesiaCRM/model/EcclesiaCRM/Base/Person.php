<?php

namespace EcclesiaCRM\Base;

use \DateTime;
use \Exception;
use \PDO;
use EcclesiaCRM\AutoPayment as ChildAutoPayment;
use EcclesiaCRM\AutoPaymentQuery as ChildAutoPaymentQuery;
use EcclesiaCRM\CKEditorTemplates as ChildCKEditorTemplates;
use EcclesiaCRM\CKEditorTemplatesQuery as ChildCKEditorTemplatesQuery;
use EcclesiaCRM\EventAttend as ChildEventAttend;
use EcclesiaCRM\EventAttendQuery as ChildEventAttendQuery;
use EcclesiaCRM\Family as ChildFamily;
use EcclesiaCRM\FamilyQuery as ChildFamilyQuery;
use EcclesiaCRM\GroupManagerPerson as ChildGroupManagerPerson;
use EcclesiaCRM\GroupManagerPersonQuery as ChildGroupManagerPersonQuery;
use EcclesiaCRM\MenuLink as ChildMenuLink;
use EcclesiaCRM\MenuLinkQuery as ChildMenuLinkQuery;
use EcclesiaCRM\Note as ChildNote;
use EcclesiaCRM\NoteQuery as ChildNoteQuery;
use EcclesiaCRM\NoteShare as ChildNoteShare;
use EcclesiaCRM\NoteShareQuery as ChildNoteShareQuery;
use EcclesiaCRM\PastoralCare as ChildPastoralCare;
use EcclesiaCRM\PastoralCareQuery as ChildPastoralCareQuery;
use EcclesiaCRM\Person as ChildPerson;
use EcclesiaCRM\Person2group2roleP2g2r as ChildPerson2group2roleP2g2r;
use EcclesiaCRM\Person2group2roleP2g2rQuery as ChildPerson2group2roleP2g2rQuery;
use EcclesiaCRM\PersonCustom as ChildPersonCustom;
use EcclesiaCRM\PersonCustomQuery as ChildPersonCustomQuery;
use EcclesiaCRM\PersonQuery as ChildPersonQuery;
use EcclesiaCRM\PersonVolunteerOpportunity as ChildPersonVolunteerOpportunity;
use EcclesiaCRM\PersonVolunteerOpportunityQuery as ChildPersonVolunteerOpportunityQuery;
use EcclesiaCRM\Pledge as ChildPledge;
use EcclesiaCRM\PledgeQuery as ChildPledgeQuery;
use EcclesiaCRM\User as ChildUser;
use EcclesiaCRM\UserQuery as ChildUserQuery;
use EcclesiaCRM\Map\AutoPaymentTableMap;
use EcclesiaCRM\Map\CKEditorTemplatesTableMap;
use EcclesiaCRM\Map\EventAttendTableMap;
use EcclesiaCRM\Map\GroupManagerPersonTableMap;
use EcclesiaCRM\Map\MenuLinkTableMap;
use EcclesiaCRM\Map\NoteShareTableMap;
use EcclesiaCRM\Map\NoteTableMap;
use EcclesiaCRM\Map\PastoralCareTableMap;
use EcclesiaCRM\Map\Person2group2roleP2g2rTableMap;
use EcclesiaCRM\Map\PersonTableMap;
use EcclesiaCRM\Map\PersonVolunteerOpportunityTableMap;
use EcclesiaCRM\Map\PledgeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'person_per' table.
 *
 * This contains the main person data, including person names, person addresses, person phone numbers, and foreign keys to the family table
 *
 * @package    propel.generator.EcclesiaCRM.Base
 */
abstract class Person implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\EcclesiaCRM\\Map\\PersonTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the per_id field.
     *
     * @var        int
     */
    protected $per_id;

    /**
     * The value for the per_title field.
     *
     * @var        string
     */
    protected $per_title;

    /**
     * The value for the per_firstname field.
     *
     * @var        string
     */
    protected $per_firstname;

    /**
     * The value for the per_middlename field.
     *
     * @var        string
     */
    protected $per_middlename;

    /**
     * The value for the per_lastname field.
     *
     * @var        string
     */
    protected $per_lastname;

    /**
     * The value for the per_suffix field.
     *
     * @var        string
     */
    protected $per_suffix;

    /**
     * The value for the per_address1 field.
     *
     * @var        string
     */
    protected $per_address1;

    /**
     * The value for the per_address2 field.
     *
     * @var        string
     */
    protected $per_address2;

    /**
     * The value for the per_city field.
     *
     * @var        string
     */
    protected $per_city;

    /**
     * The value for the per_state field.
     *
     * @var        string
     */
    protected $per_state;

    /**
     * The value for the per_zip field.
     *
     * @var        string
     */
    protected $per_zip;

    /**
     * The value for the per_country field.
     *
     * @var        string
     */
    protected $per_country;

    /**
     * The value for the per_homephone field.
     *
     * @var        string
     */
    protected $per_homephone;

    /**
     * The value for the per_workphone field.
     *
     * @var        string
     */
    protected $per_workphone;

    /**
     * The value for the per_cellphone field.
     *
     * @var        string
     */
    protected $per_cellphone;

    /**
     * The value for the per_email field.
     *
     * @var        string
     */
    protected $per_email;

    /**
     * The value for the per_workemail field.
     *
     * @var        string
     */
    protected $per_workemail;

    /**
     * The value for the per_birthmonth field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_birthmonth;

    /**
     * The value for the per_birthday field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_birthday;

    /**
     * The value for the per_birthyear field.
     *
     * @var        int
     */
    protected $per_birthyear;

    /**
     * The value for the per_membershipdate field.
     *
     * @var        DateTime
     */
    protected $per_membershipdate;

    /**
     * The value for the per_gender field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_gender;

    /**
     * The value for the per_fmr_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_fmr_id;

    /**
     * The value for the per_cls_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_cls_id;

    /**
     * The value for the per_fam_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_fam_id;

    /**
     * The value for the per_envelope field.
     *
     * @var        int
     */
    protected $per_envelope;

    /**
     * The value for the per_datelastedited field.
     *
     * @var        DateTime
     */
    protected $per_datelastedited;

    /**
     * The value for the per_dateentered field.
     *
     * @var        DateTime
     */
    protected $per_dateentered;

    /**
     * The value for the per_enteredby field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_enteredby;

    /**
     * The value for the per_editedby field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_editedby;

    /**
     * The value for the per_frienddate field.
     *
     * @var        DateTime
     */
    protected $per_frienddate;

    /**
     * The value for the per_flags field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $per_flags;

    /**
     * The value for the per_facebookid field.
     * FacebookID
     * @var        string
     */
    protected $per_facebookid;

    /**
     * The value for the per_twitter field.
     * Twitter username
     * @var        string
     */
    protected $per_twitter;

    /**
     * The value for the per_linkedin field.
     * LinkedIn name
     * @var        string
     */
    protected $per_linkedin;

    /**
     * The value for the per_datedeactivated field.
     *
     * @var        DateTime
     */
    protected $per_datedeactivated;

    /**
     * @var        ChildFamily
     */
    protected $aFamily;

    /**
     * @var        ChildPersonCustom one-to-one related ChildPersonCustom object
     */
    protected $singlePersonCustom;

    /**
     * @var        ObjectCollection|ChildNote[] Collection to store aggregation of ChildNote objects.
     */
    protected $collNotes;
    protected $collNotesPartial;

    /**
     * @var        ObjectCollection|ChildNoteShare[] Collection to store aggregation of ChildNoteShare objects.
     */
    protected $collNoteShares;
    protected $collNoteSharesPartial;

    /**
     * @var        ObjectCollection|ChildPerson2group2roleP2g2r[] Collection to store aggregation of ChildPerson2group2roleP2g2r objects.
     */
    protected $collPerson2group2roleP2g2rs;
    protected $collPerson2group2roleP2g2rsPartial;

    /**
     * @var        ObjectCollection|ChildAutoPayment[] Collection to store aggregation of ChildAutoPayment objects.
     */
    protected $collAutoPayments;
    protected $collAutoPaymentsPartial;

    /**
     * @var        ObjectCollection|ChildEventAttend[] Collection to store aggregation of ChildEventAttend objects.
     */
    protected $collEventAttends;
    protected $collEventAttendsPartial;

    /**
     * @var        ObjectCollection|ChildPledge[] Collection to store aggregation of ChildPledge objects.
     */
    protected $collPledges;
    protected $collPledgesPartial;

    /**
     * @var        ChildUser one-to-one related ChildUser object
     */
    protected $singleUser;

    /**
     * @var        ObjectCollection|ChildPersonVolunteerOpportunity[] Collection to store aggregation of ChildPersonVolunteerOpportunity objects.
     */
    protected $collPersonVolunteerOpportunities;
    protected $collPersonVolunteerOpportunitiesPartial;

    /**
     * @var        ObjectCollection|ChildGroupManagerPerson[] Collection to store aggregation of ChildGroupManagerPerson objects.
     */
    protected $collGroupManagerpeople;
    protected $collGroupManagerpeoplePartial;

    /**
     * @var        ObjectCollection|ChildCKEditorTemplates[] Collection to store aggregation of ChildCKEditorTemplates objects.
     */
    protected $collCKEditorTemplatess;
    protected $collCKEditorTemplatessPartial;

    /**
     * @var        ObjectCollection|ChildPastoralCare[] Collection to store aggregation of ChildPastoralCare objects.
     */
    protected $collPastoralCaresRelatedByPastorId;
    protected $collPastoralCaresRelatedByPastorIdPartial;

    /**
     * @var        ObjectCollection|ChildPastoralCare[] Collection to store aggregation of ChildPastoralCare objects.
     */
    protected $collPastoralCaresRelatedByPersonId;
    protected $collPastoralCaresRelatedByPersonIdPartial;

    /**
     * @var        ObjectCollection|ChildMenuLink[] Collection to store aggregation of ChildMenuLink objects.
     */
    protected $collMenuLinks;
    protected $collMenuLinksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNote[]
     */
    protected $notesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNoteShare[]
     */
    protected $noteSharesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPerson2group2roleP2g2r[]
     */
    protected $person2group2roleP2g2rsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAutoPayment[]
     */
    protected $autoPaymentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEventAttend[]
     */
    protected $eventAttendsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPledge[]
     */
    protected $pledgesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersonVolunteerOpportunity[]
     */
    protected $personVolunteerOpportunitiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGroupManagerPerson[]
     */
    protected $groupManagerpeopleScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCKEditorTemplates[]
     */
    protected $cKEditorTemplatessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPastoralCare[]
     */
    protected $pastoralCaresRelatedByPastorIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPastoralCare[]
     */
    protected $pastoralCaresRelatedByPersonIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMenuLink[]
     */
    protected $menuLinksScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->per_birthmonth = 0;
        $this->per_birthday = 0;
        $this->per_gender = 0;
        $this->per_fmr_id = 0;
        $this->per_cls_id = 0;
        $this->per_fam_id = 0;
        $this->per_enteredby = 0;
        $this->per_editedby = 0;
        $this->per_flags = 0;
    }

    /**
     * Initializes internal state of EcclesiaCRM\Base\Person object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Person</code> instance.  If
     * <code>obj</code> is an instance of <code>Person</code>, delegates to
     * <code>equals(Person)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Person The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [per_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->per_id;
    }

    /**
     * Get the [per_title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->per_title;
    }

    /**
     * Get the [per_firstname] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->per_firstname;
    }

    /**
     * Get the [per_middlename] column value.
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->per_middlename;
    }

    /**
     * Get the [per_lastname] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->per_lastname;
    }

    /**
     * Get the [per_suffix] column value.
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->per_suffix;
    }

    /**
     * Get the [per_address1] column value.
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->per_address1;
    }

    /**
     * Get the [per_address2] column value.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->per_address2;
    }

    /**
     * Get the [per_city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->per_city;
    }

    /**
     * Get the [per_state] column value.
     *
     * @return string
     */
    public function getState()
    {
        return $this->per_state;
    }

    /**
     * Get the [per_zip] column value.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->per_zip;
    }

    /**
     * Get the [per_country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->per_country;
    }

    /**
     * Get the [per_homephone] column value.
     *
     * @return string
     */
    public function getHomePhone()
    {
        return $this->per_homephone;
    }

    /**
     * Get the [per_workphone] column value.
     *
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->per_workphone;
    }

    /**
     * Get the [per_cellphone] column value.
     *
     * @return string
     */
    public function getCellPhone()
    {
        return $this->per_cellphone;
    }

    /**
     * Get the [per_email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->per_email;
    }

    /**
     * Get the [per_workemail] column value.
     *
     * @return string
     */
    public function getWorkEmail()
    {
        return $this->per_workemail;
    }

    /**
     * Get the [per_birthmonth] column value.
     *
     * @return int
     */
    public function getBirthMonth()
    {
        return $this->per_birthmonth;
    }

    /**
     * Get the [per_birthday] column value.
     *
     * @return int
     */
    public function getBirthDay()
    {
        return $this->per_birthday;
    }

    /**
     * Get the [per_birthyear] column value.
     *
     * @return int
     */
    public function getBirthYear()
    {
        return $this->per_birthyear;
    }

    /**
     * Get the [optionally formatted] temporal [per_membershipdate] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMembershipDate($format = NULL)
    {
        if ($format === null) {
            return $this->per_membershipdate;
        } else {
            return $this->per_membershipdate instanceof \DateTimeInterface ? $this->per_membershipdate->format($format) : null;
        }
    }

    /**
     * Get the [per_gender] column value.
     *
     * @return int
     */
    public function getGender()
    {
        return $this->per_gender;
    }

    /**
     * Get the [per_fmr_id] column value.
     *
     * @return int
     */
    public function getFmrId()
    {
        return $this->per_fmr_id;
    }

    /**
     * Get the [per_cls_id] column value.
     *
     * @return int
     */
    public function getClsId()
    {
        return $this->per_cls_id;
    }

    /**
     * Get the [per_fam_id] column value.
     *
     * @return int
     */
    public function getFamId()
    {
        return $this->per_fam_id;
    }

    /**
     * Get the [per_envelope] column value.
     *
     * @return int
     */
    public function getEnvelope()
    {
        return $this->per_envelope;
    }

    /**
     * Get the [optionally formatted] temporal [per_datelastedited] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateLastEdited($format = NULL)
    {
        if ($format === null) {
            return $this->per_datelastedited;
        } else {
            return $this->per_datelastedited instanceof \DateTimeInterface ? $this->per_datelastedited->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [per_dateentered] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateEntered($format = NULL)
    {
        if ($format === null) {
            return $this->per_dateentered;
        } else {
            return $this->per_dateentered instanceof \DateTimeInterface ? $this->per_dateentered->format($format) : null;
        }
    }

    /**
     * Get the [per_enteredby] column value.
     *
     * @return int
     */
    public function getEnteredBy()
    {
        return $this->per_enteredby;
    }

    /**
     * Get the [per_editedby] column value.
     *
     * @return int
     */
    public function getEditedBy()
    {
        return $this->per_editedby;
    }

    /**
     * Get the [optionally formatted] temporal [per_frienddate] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFriendDate($format = NULL)
    {
        if ($format === null) {
            return $this->per_frienddate;
        } else {
            return $this->per_frienddate instanceof \DateTimeInterface ? $this->per_frienddate->format($format) : null;
        }
    }

    /**
     * Get the [per_flags] column value.
     *
     * @return int
     */
    public function getFlags()
    {
        return $this->per_flags;
    }

    /**
     * Get the [per_facebookid] column value.
     * FacebookID
     * @return string
     */
    public function getFacebookID()
    {
        return $this->per_facebookid;
    }

    /**
     * Get the [per_twitter] column value.
     * Twitter username
     * @return string
     */
    public function getTwitter()
    {
        return $this->per_twitter;
    }

    /**
     * Get the [per_linkedin] column value.
     * LinkedIn name
     * @return string
     */
    public function getLinkedIn()
    {
        return $this->per_linkedin;
    }

    /**
     * Get the [optionally formatted] temporal [per_datedeactivated] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateDeactivated($format = NULL)
    {
        if ($format === null) {
            return $this->per_datedeactivated;
        } else {
            return $this->per_datedeactivated instanceof \DateTimeInterface ? $this->per_datedeactivated->format($format) : null;
        }
    }

    /**
     * Set the value of [per_id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_id !== $v) {
            $this->per_id = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [per_title] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_title !== $v) {
            $this->per_title = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [per_firstname] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_firstname !== $v) {
            $this->per_firstname = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_FIRSTNAME] = true;
        }

        return $this;
    } // setFirstName()

    /**
     * Set the value of [per_middlename] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setMiddleName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_middlename !== $v) {
            $this->per_middlename = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_MIDDLENAME] = true;
        }

        return $this;
    } // setMiddleName()

    /**
     * Set the value of [per_lastname] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_lastname !== $v) {
            $this->per_lastname = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_LASTNAME] = true;
        }

        return $this;
    } // setLastName()

    /**
     * Set the value of [per_suffix] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setSuffix($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_suffix !== $v) {
            $this->per_suffix = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_SUFFIX] = true;
        }

        return $this;
    } // setSuffix()

    /**
     * Set the value of [per_address1] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_address1 !== $v) {
            $this->per_address1 = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_ADDRESS1] = true;
        }

        return $this;
    } // setAddress1()

    /**
     * Set the value of [per_address2] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_address2 !== $v) {
            $this->per_address2 = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_ADDRESS2] = true;
        }

        return $this;
    } // setAddress2()

    /**
     * Set the value of [per_city] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_city !== $v) {
            $this->per_city = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [per_state] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_state !== $v) {
            $this->per_state = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Set the value of [per_zip] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setZip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_zip !== $v) {
            $this->per_zip = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_ZIP] = true;
        }

        return $this;
    } // setZip()

    /**
     * Set the value of [per_country] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_country !== $v) {
            $this->per_country = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Set the value of [per_homephone] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setHomePhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_homephone !== $v) {
            $this->per_homephone = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_HOMEPHONE] = true;
        }

        return $this;
    } // setHomePhone()

    /**
     * Set the value of [per_workphone] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setWorkPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_workphone !== $v) {
            $this->per_workphone = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_WORKPHONE] = true;
        }

        return $this;
    } // setWorkPhone()

    /**
     * Set the value of [per_cellphone] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setCellPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_cellphone !== $v) {
            $this->per_cellphone = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_CELLPHONE] = true;
        }

        return $this;
    } // setCellPhone()

    /**
     * Set the value of [per_email] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_email !== $v) {
            $this->per_email = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [per_workemail] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setWorkEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_workemail !== $v) {
            $this->per_workemail = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_WORKEMAIL] = true;
        }

        return $this;
    } // setWorkEmail()

    /**
     * Set the value of [per_birthmonth] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setBirthMonth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_birthmonth !== $v) {
            $this->per_birthmonth = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_BIRTHMONTH] = true;
        }

        return $this;
    } // setBirthMonth()

    /**
     * Set the value of [per_birthday] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setBirthDay($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_birthday !== $v) {
            $this->per_birthday = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_BIRTHDAY] = true;
        }

        return $this;
    } // setBirthDay()

    /**
     * Set the value of [per_birthyear] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setBirthYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_birthyear !== $v) {
            $this->per_birthyear = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_BIRTHYEAR] = true;
        }

        return $this;
    } // setBirthYear()

    /**
     * Sets the value of [per_membershipdate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setMembershipDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_membershipdate !== null || $dt !== null) {
            if ($this->per_membershipdate === null || $dt === null || $dt->format("Y-m-d") !== $this->per_membershipdate->format("Y-m-d")) {
                $this->per_membershipdate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersonTableMap::COL_PER_MEMBERSHIPDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setMembershipDate()

    /**
     * Set the value of [per_gender] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_gender !== $v) {
            $this->per_gender = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_GENDER] = true;
        }

        return $this;
    } // setGender()

    /**
     * Set the value of [per_fmr_id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setFmrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_fmr_id !== $v) {
            $this->per_fmr_id = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_FMR_ID] = true;
        }

        return $this;
    } // setFmrId()

    /**
     * Set the value of [per_cls_id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setClsId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_cls_id !== $v) {
            $this->per_cls_id = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_CLS_ID] = true;
        }

        return $this;
    } // setClsId()

    /**
     * Set the value of [per_fam_id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setFamId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_fam_id !== $v) {
            $this->per_fam_id = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_FAM_ID] = true;
        }

        if ($this->aFamily !== null && $this->aFamily->getId() !== $v) {
            $this->aFamily = null;
        }

        return $this;
    } // setFamId()

    /**
     * Set the value of [per_envelope] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setEnvelope($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_envelope !== $v) {
            $this->per_envelope = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_ENVELOPE] = true;
        }

        return $this;
    } // setEnvelope()

    /**
     * Sets the value of [per_datelastedited] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setDateLastEdited($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_datelastedited !== null || $dt !== null) {
            if ($this->per_datelastedited === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->per_datelastedited->format("Y-m-d H:i:s.u")) {
                $this->per_datelastedited = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersonTableMap::COL_PER_DATELASTEDITED] = true;
            }
        } // if either are not null

        return $this;
    } // setDateLastEdited()

    /**
     * Sets the value of [per_dateentered] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setDateEntered($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_dateentered !== null || $dt !== null) {
            if ($this->per_dateentered === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->per_dateentered->format("Y-m-d H:i:s.u")) {
                $this->per_dateentered = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersonTableMap::COL_PER_DATEENTERED] = true;
            }
        } // if either are not null

        return $this;
    } // setDateEntered()

    /**
     * Set the value of [per_enteredby] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setEnteredBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_enteredby !== $v) {
            $this->per_enteredby = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_ENTEREDBY] = true;
        }

        return $this;
    } // setEnteredBy()

    /**
     * Set the value of [per_editedby] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setEditedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_editedby !== $v) {
            $this->per_editedby = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_EDITEDBY] = true;
        }

        return $this;
    } // setEditedBy()

    /**
     * Sets the value of [per_frienddate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setFriendDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_frienddate !== null || $dt !== null) {
            if ($this->per_frienddate === null || $dt === null || $dt->format("Y-m-d") !== $this->per_frienddate->format("Y-m-d")) {
                $this->per_frienddate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersonTableMap::COL_PER_FRIENDDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setFriendDate()

    /**
     * Set the value of [per_flags] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_flags !== $v) {
            $this->per_flags = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_FLAGS] = true;
        }

        return $this;
    } // setFlags()

    /**
     * Set the value of [per_facebookid] column.
     * FacebookID
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setFacebookID($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_facebookid !== $v) {
            $this->per_facebookid = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_FACEBOOKID] = true;
        }

        return $this;
    } // setFacebookID()

    /**
     * Set the value of [per_twitter] column.
     * Twitter username
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setTwitter($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_twitter !== $v) {
            $this->per_twitter = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_TWITTER] = true;
        }

        return $this;
    } // setTwitter()

    /**
     * Set the value of [per_linkedin] column.
     * LinkedIn name
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setLinkedIn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_linkedin !== $v) {
            $this->per_linkedin = $v;
            $this->modifiedColumns[PersonTableMap::COL_PER_LINKEDIN] = true;
        }

        return $this;
    } // setLinkedIn()

    /**
     * Sets the value of [per_datedeactivated] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function setDateDeactivated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_datedeactivated !== null || $dt !== null) {
            if ($this->per_datedeactivated === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->per_datedeactivated->format("Y-m-d H:i:s.u")) {
                $this->per_datedeactivated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PersonTableMap::COL_PER_DATEDEACTIVATED] = true;
            }
        } // if either are not null

        return $this;
    } // setDateDeactivated()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->per_birthmonth !== 0) {
                return false;
            }

            if ($this->per_birthday !== 0) {
                return false;
            }

            if ($this->per_gender !== 0) {
                return false;
            }

            if ($this->per_fmr_id !== 0) {
                return false;
            }

            if ($this->per_cls_id !== 0) {
                return false;
            }

            if ($this->per_fam_id !== 0) {
                return false;
            }

            if ($this->per_enteredby !== 0) {
                return false;
            }

            if ($this->per_editedby !== 0) {
                return false;
            }

            if ($this->per_flags !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PersonTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PersonTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PersonTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_firstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PersonTableMap::translateFieldName('MiddleName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_middlename = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PersonTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_lastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PersonTableMap::translateFieldName('Suffix', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_suffix = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PersonTableMap::translateFieldName('Address1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_address1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PersonTableMap::translateFieldName('Address2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_address2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PersonTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PersonTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PersonTableMap::translateFieldName('Zip', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_zip = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PersonTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PersonTableMap::translateFieldName('HomePhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_homephone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PersonTableMap::translateFieldName('WorkPhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_workphone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PersonTableMap::translateFieldName('CellPhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_cellphone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PersonTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PersonTableMap::translateFieldName('WorkEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_workemail = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : PersonTableMap::translateFieldName('BirthMonth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_birthmonth = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : PersonTableMap::translateFieldName('BirthDay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_birthday = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : PersonTableMap::translateFieldName('BirthYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_birthyear = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : PersonTableMap::translateFieldName('MembershipDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->per_membershipdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : PersonTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_gender = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : PersonTableMap::translateFieldName('FmrId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_fmr_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : PersonTableMap::translateFieldName('ClsId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_cls_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : PersonTableMap::translateFieldName('FamId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_fam_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : PersonTableMap::translateFieldName('Envelope', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_envelope = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : PersonTableMap::translateFieldName('DateLastEdited', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->per_datelastedited = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : PersonTableMap::translateFieldName('DateEntered', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->per_dateentered = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : PersonTableMap::translateFieldName('EnteredBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_enteredby = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : PersonTableMap::translateFieldName('EditedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_editedby = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : PersonTableMap::translateFieldName('FriendDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->per_frienddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : PersonTableMap::translateFieldName('Flags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : PersonTableMap::translateFieldName('FacebookID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_facebookid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : PersonTableMap::translateFieldName('Twitter', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_twitter = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : PersonTableMap::translateFieldName('LinkedIn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->per_linkedin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : PersonTableMap::translateFieldName('DateDeactivated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->per_datedeactivated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 36; // 36 = PersonTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\EcclesiaCRM\\Person'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aFamily !== null && $this->per_fam_id !== $this->aFamily->getId()) {
            $this->aFamily = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersonTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPersonQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFamily = null;
            $this->singlePersonCustom = null;

            $this->collNotes = null;

            $this->collNoteShares = null;

            $this->collPerson2group2roleP2g2rs = null;

            $this->collAutoPayments = null;

            $this->collEventAttends = null;

            $this->collPledges = null;

            $this->singleUser = null;

            $this->collPersonVolunteerOpportunities = null;

            $this->collGroupManagerpeople = null;

            $this->collCKEditorTemplatess = null;

            $this->collPastoralCaresRelatedByPastorId = null;

            $this->collPastoralCaresRelatedByPersonId = null;

            $this->collMenuLinks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Person::setDeleted()
     * @see Person::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPersonQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PersonTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aFamily !== null) {
                if ($this->aFamily->isModified() || $this->aFamily->isNew()) {
                    $affectedRows += $this->aFamily->save($con);
                }
                $this->setFamily($this->aFamily);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->singlePersonCustom !== null) {
                if (!$this->singlePersonCustom->isDeleted() && ($this->singlePersonCustom->isNew() || $this->singlePersonCustom->isModified())) {
                    $affectedRows += $this->singlePersonCustom->save($con);
                }
            }

            if ($this->notesScheduledForDeletion !== null) {
                if (!$this->notesScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\NoteQuery::create()
                        ->filterByPrimaryKeys($this->notesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->notesScheduledForDeletion = null;
                }
            }

            if ($this->collNotes !== null) {
                foreach ($this->collNotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->noteSharesScheduledForDeletion !== null) {
                if (!$this->noteSharesScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\NoteShareQuery::create()
                        ->filterByPrimaryKeys($this->noteSharesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->noteSharesScheduledForDeletion = null;
                }
            }

            if ($this->collNoteShares !== null) {
                foreach ($this->collNoteShares as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->person2group2roleP2g2rsScheduledForDeletion !== null) {
                if (!$this->person2group2roleP2g2rsScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\Person2group2roleP2g2rQuery::create()
                        ->filterByPrimaryKeys($this->person2group2roleP2g2rsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->person2group2roleP2g2rsScheduledForDeletion = null;
                }
            }

            if ($this->collPerson2group2roleP2g2rs !== null) {
                foreach ($this->collPerson2group2roleP2g2rs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->autoPaymentsScheduledForDeletion !== null) {
                if (!$this->autoPaymentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->autoPaymentsScheduledForDeletion as $autoPayment) {
                        // need to save related object because we set the relation to null
                        $autoPayment->save($con);
                    }
                    $this->autoPaymentsScheduledForDeletion = null;
                }
            }

            if ($this->collAutoPayments !== null) {
                foreach ($this->collAutoPayments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->eventAttendsScheduledForDeletion !== null) {
                if (!$this->eventAttendsScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\EventAttendQuery::create()
                        ->filterByPrimaryKeys($this->eventAttendsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->eventAttendsScheduledForDeletion = null;
                }
            }

            if ($this->collEventAttends !== null) {
                foreach ($this->collEventAttends as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pledgesScheduledForDeletion !== null) {
                if (!$this->pledgesScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\PledgeQuery::create()
                        ->filterByPrimaryKeys($this->pledgesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pledgesScheduledForDeletion = null;
                }
            }

            if ($this->collPledges !== null) {
                foreach ($this->collPledges as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleUser !== null) {
                if (!$this->singleUser->isDeleted() && ($this->singleUser->isNew() || $this->singleUser->isModified())) {
                    $affectedRows += $this->singleUser->save($con);
                }
            }

            if ($this->personVolunteerOpportunitiesScheduledForDeletion !== null) {
                if (!$this->personVolunteerOpportunitiesScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\PersonVolunteerOpportunityQuery::create()
                        ->filterByPrimaryKeys($this->personVolunteerOpportunitiesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->personVolunteerOpportunitiesScheduledForDeletion = null;
                }
            }

            if ($this->collPersonVolunteerOpportunities !== null) {
                foreach ($this->collPersonVolunteerOpportunities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->groupManagerpeopleScheduledForDeletion !== null) {
                if (!$this->groupManagerpeopleScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\GroupManagerPersonQuery::create()
                        ->filterByPrimaryKeys($this->groupManagerpeopleScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->groupManagerpeopleScheduledForDeletion = null;
                }
            }

            if ($this->collGroupManagerpeople !== null) {
                foreach ($this->collGroupManagerpeople as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->cKEditorTemplatessScheduledForDeletion !== null) {
                if (!$this->cKEditorTemplatessScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\CKEditorTemplatesQuery::create()
                        ->filterByPrimaryKeys($this->cKEditorTemplatessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->cKEditorTemplatessScheduledForDeletion = null;
                }
            }

            if ($this->collCKEditorTemplatess !== null) {
                foreach ($this->collCKEditorTemplatess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pastoralCaresRelatedByPastorIdScheduledForDeletion !== null) {
                if (!$this->pastoralCaresRelatedByPastorIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->pastoralCaresRelatedByPastorIdScheduledForDeletion as $pastoralCareRelatedByPastorId) {
                        // need to save related object because we set the relation to null
                        $pastoralCareRelatedByPastorId->save($con);
                    }
                    $this->pastoralCaresRelatedByPastorIdScheduledForDeletion = null;
                }
            }

            if ($this->collPastoralCaresRelatedByPastorId !== null) {
                foreach ($this->collPastoralCaresRelatedByPastorId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pastoralCaresRelatedByPersonIdScheduledForDeletion !== null) {
                if (!$this->pastoralCaresRelatedByPersonIdScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\PastoralCareQuery::create()
                        ->filterByPrimaryKeys($this->pastoralCaresRelatedByPersonIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pastoralCaresRelatedByPersonIdScheduledForDeletion = null;
                }
            }

            if ($this->collPastoralCaresRelatedByPersonId !== null) {
                foreach ($this->collPastoralCaresRelatedByPersonId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->menuLinksScheduledForDeletion !== null) {
                if (!$this->menuLinksScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\MenuLinkQuery::create()
                        ->filterByPrimaryKeys($this->menuLinksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->menuLinksScheduledForDeletion = null;
                }
            }

            if ($this->collMenuLinks !== null) {
                foreach ($this->collMenuLinks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PersonTableMap::COL_PER_ID] = true;
        if (null !== $this->per_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PersonTableMap::COL_PER_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PersonTableMap::COL_PER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'per_ID';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'per_Title';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'per_FirstName';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_MIDDLENAME)) {
            $modifiedColumns[':p' . $index++]  = 'per_MiddleName';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'per_LastName';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_SUFFIX)) {
            $modifiedColumns[':p' . $index++]  = 'per_Suffix';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ADDRESS1)) {
            $modifiedColumns[':p' . $index++]  = 'per_Address1';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = 'per_Address2';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'per_City';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'per_State';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ZIP)) {
            $modifiedColumns[':p' . $index++]  = 'per_Zip';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'per_Country';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_HOMEPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'per_HomePhone';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_WORKPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'per_WorkPhone';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_CELLPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'per_CellPhone';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'per_Email';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_WORKEMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'per_WorkEmail';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_BIRTHMONTH)) {
            $modifiedColumns[':p' . $index++]  = 'per_BirthMonth';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_BIRTHDAY)) {
            $modifiedColumns[':p' . $index++]  = 'per_BirthDay';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_BIRTHYEAR)) {
            $modifiedColumns[':p' . $index++]  = 'per_BirthYear';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_MEMBERSHIPDATE)) {
            $modifiedColumns[':p' . $index++]  = 'per_MembershipDate';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'per_Gender';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FMR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'per_fmr_ID';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_CLS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'per_cls_ID';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FAM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'per_fam_ID';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ENVELOPE)) {
            $modifiedColumns[':p' . $index++]  = 'per_Envelope';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_DATELASTEDITED)) {
            $modifiedColumns[':p' . $index++]  = 'per_DateLastEdited';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_DATEENTERED)) {
            $modifiedColumns[':p' . $index++]  = 'per_DateEntered';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ENTEREDBY)) {
            $modifiedColumns[':p' . $index++]  = 'per_EnteredBy';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_EDITEDBY)) {
            $modifiedColumns[':p' . $index++]  = 'per_EditedBy';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FRIENDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'per_FriendDate';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = 'per_Flags';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FACEBOOKID)) {
            $modifiedColumns[':p' . $index++]  = 'per_FacebookID';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_TWITTER)) {
            $modifiedColumns[':p' . $index++]  = 'per_Twitter';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_LINKEDIN)) {
            $modifiedColumns[':p' . $index++]  = 'per_LinkedIn';
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_DATEDEACTIVATED)) {
            $modifiedColumns[':p' . $index++]  = 'per_DateDeactivated';
        }

        $sql = sprintf(
            'INSERT INTO person_per (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'per_ID':
                        $stmt->bindValue($identifier, $this->per_id, PDO::PARAM_INT);
                        break;
                    case 'per_Title':
                        $stmt->bindValue($identifier, $this->per_title, PDO::PARAM_STR);
                        break;
                    case 'per_FirstName':
                        $stmt->bindValue($identifier, $this->per_firstname, PDO::PARAM_STR);
                        break;
                    case 'per_MiddleName':
                        $stmt->bindValue($identifier, $this->per_middlename, PDO::PARAM_STR);
                        break;
                    case 'per_LastName':
                        $stmt->bindValue($identifier, $this->per_lastname, PDO::PARAM_STR);
                        break;
                    case 'per_Suffix':
                        $stmt->bindValue($identifier, $this->per_suffix, PDO::PARAM_STR);
                        break;
                    case 'per_Address1':
                        $stmt->bindValue($identifier, $this->per_address1, PDO::PARAM_STR);
                        break;
                    case 'per_Address2':
                        $stmt->bindValue($identifier, $this->per_address2, PDO::PARAM_STR);
                        break;
                    case 'per_City':
                        $stmt->bindValue($identifier, $this->per_city, PDO::PARAM_STR);
                        break;
                    case 'per_State':
                        $stmt->bindValue($identifier, $this->per_state, PDO::PARAM_STR);
                        break;
                    case 'per_Zip':
                        $stmt->bindValue($identifier, $this->per_zip, PDO::PARAM_STR);
                        break;
                    case 'per_Country':
                        $stmt->bindValue($identifier, $this->per_country, PDO::PARAM_STR);
                        break;
                    case 'per_HomePhone':
                        $stmt->bindValue($identifier, $this->per_homephone, PDO::PARAM_STR);
                        break;
                    case 'per_WorkPhone':
                        $stmt->bindValue($identifier, $this->per_workphone, PDO::PARAM_STR);
                        break;
                    case 'per_CellPhone':
                        $stmt->bindValue($identifier, $this->per_cellphone, PDO::PARAM_STR);
                        break;
                    case 'per_Email':
                        $stmt->bindValue($identifier, $this->per_email, PDO::PARAM_STR);
                        break;
                    case 'per_WorkEmail':
                        $stmt->bindValue($identifier, $this->per_workemail, PDO::PARAM_STR);
                        break;
                    case 'per_BirthMonth':
                        $stmt->bindValue($identifier, $this->per_birthmonth, PDO::PARAM_INT);
                        break;
                    case 'per_BirthDay':
                        $stmt->bindValue($identifier, $this->per_birthday, PDO::PARAM_INT);
                        break;
                    case 'per_BirthYear':
                        $stmt->bindValue($identifier, $this->per_birthyear, PDO::PARAM_INT);
                        break;
                    case 'per_MembershipDate':
                        $stmt->bindValue($identifier, $this->per_membershipdate ? $this->per_membershipdate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'per_Gender':
                        $stmt->bindValue($identifier, $this->per_gender, PDO::PARAM_INT);
                        break;
                    case 'per_fmr_ID':
                        $stmt->bindValue($identifier, $this->per_fmr_id, PDO::PARAM_INT);
                        break;
                    case 'per_cls_ID':
                        $stmt->bindValue($identifier, $this->per_cls_id, PDO::PARAM_INT);
                        break;
                    case 'per_fam_ID':
                        $stmt->bindValue($identifier, $this->per_fam_id, PDO::PARAM_INT);
                        break;
                    case 'per_Envelope':
                        $stmt->bindValue($identifier, $this->per_envelope, PDO::PARAM_INT);
                        break;
                    case 'per_DateLastEdited':
                        $stmt->bindValue($identifier, $this->per_datelastedited ? $this->per_datelastedited->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'per_DateEntered':
                        $stmt->bindValue($identifier, $this->per_dateentered ? $this->per_dateentered->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'per_EnteredBy':
                        $stmt->bindValue($identifier, $this->per_enteredby, PDO::PARAM_INT);
                        break;
                    case 'per_EditedBy':
                        $stmt->bindValue($identifier, $this->per_editedby, PDO::PARAM_INT);
                        break;
                    case 'per_FriendDate':
                        $stmt->bindValue($identifier, $this->per_frienddate ? $this->per_frienddate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'per_Flags':
                        $stmt->bindValue($identifier, $this->per_flags, PDO::PARAM_INT);
                        break;
                    case 'per_FacebookID':
                        $stmt->bindValue($identifier, $this->per_facebookid, PDO::PARAM_INT);
                        break;
                    case 'per_Twitter':
                        $stmt->bindValue($identifier, $this->per_twitter, PDO::PARAM_STR);
                        break;
                    case 'per_LinkedIn':
                        $stmt->bindValue($identifier, $this->per_linkedin, PDO::PARAM_STR);
                        break;
                    case 'per_DateDeactivated':
                        $stmt->bindValue($identifier, $this->per_datedeactivated ? $this->per_datedeactivated->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getFirstName();
                break;
            case 3:
                return $this->getMiddleName();
                break;
            case 4:
                return $this->getLastName();
                break;
            case 5:
                return $this->getSuffix();
                break;
            case 6:
                return $this->getAddress1();
                break;
            case 7:
                return $this->getAddress2();
                break;
            case 8:
                return $this->getCity();
                break;
            case 9:
                return $this->getState();
                break;
            case 10:
                return $this->getZip();
                break;
            case 11:
                return $this->getCountry();
                break;
            case 12:
                return $this->getHomePhone();
                break;
            case 13:
                return $this->getWorkPhone();
                break;
            case 14:
                return $this->getCellPhone();
                break;
            case 15:
                return $this->getEmail();
                break;
            case 16:
                return $this->getWorkEmail();
                break;
            case 17:
                return $this->getBirthMonth();
                break;
            case 18:
                return $this->getBirthDay();
                break;
            case 19:
                return $this->getBirthYear();
                break;
            case 20:
                return $this->getMembershipDate();
                break;
            case 21:
                return $this->getGender();
                break;
            case 22:
                return $this->getFmrId();
                break;
            case 23:
                return $this->getClsId();
                break;
            case 24:
                return $this->getFamId();
                break;
            case 25:
                return $this->getEnvelope();
                break;
            case 26:
                return $this->getDateLastEdited();
                break;
            case 27:
                return $this->getDateEntered();
                break;
            case 28:
                return $this->getEnteredBy();
                break;
            case 29:
                return $this->getEditedBy();
                break;
            case 30:
                return $this->getFriendDate();
                break;
            case 31:
                return $this->getFlags();
                break;
            case 32:
                return $this->getFacebookID();
                break;
            case 33:
                return $this->getTwitter();
                break;
            case 34:
                return $this->getLinkedIn();
                break;
            case 35:
                return $this->getDateDeactivated();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Person'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Person'][$this->hashCode()] = true;
        $keys = PersonTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getFirstName(),
            $keys[3] => $this->getMiddleName(),
            $keys[4] => $this->getLastName(),
            $keys[5] => $this->getSuffix(),
            $keys[6] => $this->getAddress1(),
            $keys[7] => $this->getAddress2(),
            $keys[8] => $this->getCity(),
            $keys[9] => $this->getState(),
            $keys[10] => $this->getZip(),
            $keys[11] => $this->getCountry(),
            $keys[12] => $this->getHomePhone(),
            $keys[13] => $this->getWorkPhone(),
            $keys[14] => $this->getCellPhone(),
            $keys[15] => $this->getEmail(),
            $keys[16] => $this->getWorkEmail(),
            $keys[17] => $this->getBirthMonth(),
            $keys[18] => $this->getBirthDay(),
            $keys[19] => $this->getBirthYear(),
            $keys[20] => $this->getMembershipDate(),
            $keys[21] => $this->getGender(),
            $keys[22] => $this->getFmrId(),
            $keys[23] => $this->getClsId(),
            $keys[24] => $this->getFamId(),
            $keys[25] => $this->getEnvelope(),
            $keys[26] => $this->getDateLastEdited(),
            $keys[27] => $this->getDateEntered(),
            $keys[28] => $this->getEnteredBy(),
            $keys[29] => $this->getEditedBy(),
            $keys[30] => $this->getFriendDate(),
            $keys[31] => $this->getFlags(),
            $keys[32] => $this->getFacebookID(),
            $keys[33] => $this->getTwitter(),
            $keys[34] => $this->getLinkedIn(),
            $keys[35] => $this->getDateDeactivated(),
        );
        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('c');
        }

        if ($result[$keys[26]] instanceof \DateTimeInterface) {
            $result[$keys[26]] = $result[$keys[26]]->format('c');
        }

        if ($result[$keys[27]] instanceof \DateTimeInterface) {
            $result[$keys[27]] = $result[$keys[27]]->format('c');
        }

        if ($result[$keys[30]] instanceof \DateTimeInterface) {
            $result[$keys[30]] = $result[$keys[30]]->format('c');
        }

        if ($result[$keys[35]] instanceof \DateTimeInterface) {
            $result[$keys[35]] = $result[$keys[35]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFamily) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'family';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'family_fam';
                        break;
                    default:
                        $key = 'Family';
                }

                $result[$key] = $this->aFamily->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->singlePersonCustom) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'personCustom';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'person_custom';
                        break;
                    default:
                        $key = 'PersonCustom';
                }

                $result[$key] = $this->singlePersonCustom->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->collNotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'notes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'note_ntes';
                        break;
                    default:
                        $key = 'Notes';
                }

                $result[$key] = $this->collNotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNoteShares) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'noteShares';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'note_nte_shares';
                        break;
                    default:
                        $key = 'NoteShares';
                }

                $result[$key] = $this->collNoteShares->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPerson2group2roleP2g2rs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'person2group2roleP2g2rs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'person2group2role_p2g2rs';
                        break;
                    default:
                        $key = 'Person2group2roleP2g2rs';
                }

                $result[$key] = $this->collPerson2group2roleP2g2rs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAutoPayments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'autoPayments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'autopayment_auts';
                        break;
                    default:
                        $key = 'AutoPayments';
                }

                $result[$key] = $this->collAutoPayments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEventAttends) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'eventAttends';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'event_attends';
                        break;
                    default:
                        $key = 'EventAttends';
                }

                $result[$key] = $this->collEventAttends->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPledges) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pledges';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pledge_plgs';
                        break;
                    default:
                        $key = 'Pledges';
                }

                $result[$key] = $this->collPledges->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_usr';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->singleUser->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPersonVolunteerOpportunities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'personVolunteerOpportunities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'person2volunteeropp_p2vos';
                        break;
                    default:
                        $key = 'PersonVolunteerOpportunities';
                }

                $result[$key] = $this->collPersonVolunteerOpportunities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGroupManagerpeople) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'groupManagerpeople';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'group_manager_people';
                        break;
                    default:
                        $key = 'GroupManagerpeople';
                }

                $result[$key] = $this->collGroupManagerpeople->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCKEditorTemplatess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cKEditorTemplatess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ckeditor_templatess';
                        break;
                    default:
                        $key = 'CKEditorTemplatess';
                }

                $result[$key] = $this->collCKEditorTemplatess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPastoralCaresRelatedByPastorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pastoralCares';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pastoral_cares';
                        break;
                    default:
                        $key = 'PastoralCares';
                }

                $result[$key] = $this->collPastoralCaresRelatedByPastorId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPastoralCaresRelatedByPersonId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pastoralCares';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pastoral_cares';
                        break;
                    default:
                        $key = 'PastoralCares';
                }

                $result[$key] = $this->collPastoralCaresRelatedByPersonId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMenuLinks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'menuLinks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'menu_linkss';
                        break;
                    default:
                        $key = 'MenuLinks';
                }

                $result[$key] = $this->collMenuLinks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\EcclesiaCRM\Person
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\EcclesiaCRM\Person
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setFirstName($value);
                break;
            case 3:
                $this->setMiddleName($value);
                break;
            case 4:
                $this->setLastName($value);
                break;
            case 5:
                $this->setSuffix($value);
                break;
            case 6:
                $this->setAddress1($value);
                break;
            case 7:
                $this->setAddress2($value);
                break;
            case 8:
                $this->setCity($value);
                break;
            case 9:
                $this->setState($value);
                break;
            case 10:
                $this->setZip($value);
                break;
            case 11:
                $this->setCountry($value);
                break;
            case 12:
                $this->setHomePhone($value);
                break;
            case 13:
                $this->setWorkPhone($value);
                break;
            case 14:
                $this->setCellPhone($value);
                break;
            case 15:
                $this->setEmail($value);
                break;
            case 16:
                $this->setWorkEmail($value);
                break;
            case 17:
                $this->setBirthMonth($value);
                break;
            case 18:
                $this->setBirthDay($value);
                break;
            case 19:
                $this->setBirthYear($value);
                break;
            case 20:
                $this->setMembershipDate($value);
                break;
            case 21:
                $this->setGender($value);
                break;
            case 22:
                $this->setFmrId($value);
                break;
            case 23:
                $this->setClsId($value);
                break;
            case 24:
                $this->setFamId($value);
                break;
            case 25:
                $this->setEnvelope($value);
                break;
            case 26:
                $this->setDateLastEdited($value);
                break;
            case 27:
                $this->setDateEntered($value);
                break;
            case 28:
                $this->setEnteredBy($value);
                break;
            case 29:
                $this->setEditedBy($value);
                break;
            case 30:
                $this->setFriendDate($value);
                break;
            case 31:
                $this->setFlags($value);
                break;
            case 32:
                $this->setFacebookID($value);
                break;
            case 33:
                $this->setTwitter($value);
                break;
            case 34:
                $this->setLinkedIn($value);
                break;
            case 35:
                $this->setDateDeactivated($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PersonTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFirstName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMiddleName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLastName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSuffix($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddress1($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAddress2($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCity($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setState($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setZip($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCountry($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setHomePhone($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setWorkPhone($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCellPhone($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setEmail($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setWorkEmail($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setBirthMonth($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setBirthDay($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setBirthYear($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setMembershipDate($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setGender($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setFmrId($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setClsId($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setFamId($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setEnvelope($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setDateLastEdited($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setDateEntered($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setEnteredBy($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setEditedBy($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setFriendDate($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setFlags($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setFacebookID($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setTwitter($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setLinkedIn($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setDateDeactivated($arr[$keys[35]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\EcclesiaCRM\Person The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PersonTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PersonTableMap::COL_PER_ID)) {
            $criteria->add(PersonTableMap::COL_PER_ID, $this->per_id);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_TITLE)) {
            $criteria->add(PersonTableMap::COL_PER_TITLE, $this->per_title);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FIRSTNAME)) {
            $criteria->add(PersonTableMap::COL_PER_FIRSTNAME, $this->per_firstname);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_MIDDLENAME)) {
            $criteria->add(PersonTableMap::COL_PER_MIDDLENAME, $this->per_middlename);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_LASTNAME)) {
            $criteria->add(PersonTableMap::COL_PER_LASTNAME, $this->per_lastname);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_SUFFIX)) {
            $criteria->add(PersonTableMap::COL_PER_SUFFIX, $this->per_suffix);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ADDRESS1)) {
            $criteria->add(PersonTableMap::COL_PER_ADDRESS1, $this->per_address1);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ADDRESS2)) {
            $criteria->add(PersonTableMap::COL_PER_ADDRESS2, $this->per_address2);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_CITY)) {
            $criteria->add(PersonTableMap::COL_PER_CITY, $this->per_city);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_STATE)) {
            $criteria->add(PersonTableMap::COL_PER_STATE, $this->per_state);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ZIP)) {
            $criteria->add(PersonTableMap::COL_PER_ZIP, $this->per_zip);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_COUNTRY)) {
            $criteria->add(PersonTableMap::COL_PER_COUNTRY, $this->per_country);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_HOMEPHONE)) {
            $criteria->add(PersonTableMap::COL_PER_HOMEPHONE, $this->per_homephone);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_WORKPHONE)) {
            $criteria->add(PersonTableMap::COL_PER_WORKPHONE, $this->per_workphone);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_CELLPHONE)) {
            $criteria->add(PersonTableMap::COL_PER_CELLPHONE, $this->per_cellphone);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_EMAIL)) {
            $criteria->add(PersonTableMap::COL_PER_EMAIL, $this->per_email);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_WORKEMAIL)) {
            $criteria->add(PersonTableMap::COL_PER_WORKEMAIL, $this->per_workemail);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_BIRTHMONTH)) {
            $criteria->add(PersonTableMap::COL_PER_BIRTHMONTH, $this->per_birthmonth);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_BIRTHDAY)) {
            $criteria->add(PersonTableMap::COL_PER_BIRTHDAY, $this->per_birthday);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_BIRTHYEAR)) {
            $criteria->add(PersonTableMap::COL_PER_BIRTHYEAR, $this->per_birthyear);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_MEMBERSHIPDATE)) {
            $criteria->add(PersonTableMap::COL_PER_MEMBERSHIPDATE, $this->per_membershipdate);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_GENDER)) {
            $criteria->add(PersonTableMap::COL_PER_GENDER, $this->per_gender);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FMR_ID)) {
            $criteria->add(PersonTableMap::COL_PER_FMR_ID, $this->per_fmr_id);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_CLS_ID)) {
            $criteria->add(PersonTableMap::COL_PER_CLS_ID, $this->per_cls_id);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FAM_ID)) {
            $criteria->add(PersonTableMap::COL_PER_FAM_ID, $this->per_fam_id);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ENVELOPE)) {
            $criteria->add(PersonTableMap::COL_PER_ENVELOPE, $this->per_envelope);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_DATELASTEDITED)) {
            $criteria->add(PersonTableMap::COL_PER_DATELASTEDITED, $this->per_datelastedited);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_DATEENTERED)) {
            $criteria->add(PersonTableMap::COL_PER_DATEENTERED, $this->per_dateentered);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_ENTEREDBY)) {
            $criteria->add(PersonTableMap::COL_PER_ENTEREDBY, $this->per_enteredby);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_EDITEDBY)) {
            $criteria->add(PersonTableMap::COL_PER_EDITEDBY, $this->per_editedby);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FRIENDDATE)) {
            $criteria->add(PersonTableMap::COL_PER_FRIENDDATE, $this->per_frienddate);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FLAGS)) {
            $criteria->add(PersonTableMap::COL_PER_FLAGS, $this->per_flags);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_FACEBOOKID)) {
            $criteria->add(PersonTableMap::COL_PER_FACEBOOKID, $this->per_facebookid);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_TWITTER)) {
            $criteria->add(PersonTableMap::COL_PER_TWITTER, $this->per_twitter);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_LINKEDIN)) {
            $criteria->add(PersonTableMap::COL_PER_LINKEDIN, $this->per_linkedin);
        }
        if ($this->isColumnModified(PersonTableMap::COL_PER_DATEDEACTIVATED)) {
            $criteria->add(PersonTableMap::COL_PER_DATEDEACTIVATED, $this->per_datedeactivated);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPersonQuery::create();
        $criteria->add(PersonTableMap::COL_PER_ID, $this->per_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (per_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \EcclesiaCRM\Person (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setMiddleName($this->getMiddleName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setSuffix($this->getSuffix());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setCity($this->getCity());
        $copyObj->setState($this->getState());
        $copyObj->setZip($this->getZip());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setHomePhone($this->getHomePhone());
        $copyObj->setWorkPhone($this->getWorkPhone());
        $copyObj->setCellPhone($this->getCellPhone());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setWorkEmail($this->getWorkEmail());
        $copyObj->setBirthMonth($this->getBirthMonth());
        $copyObj->setBirthDay($this->getBirthDay());
        $copyObj->setBirthYear($this->getBirthYear());
        $copyObj->setMembershipDate($this->getMembershipDate());
        $copyObj->setGender($this->getGender());
        $copyObj->setFmrId($this->getFmrId());
        $copyObj->setClsId($this->getClsId());
        $copyObj->setFamId($this->getFamId());
        $copyObj->setEnvelope($this->getEnvelope());
        $copyObj->setDateLastEdited($this->getDateLastEdited());
        $copyObj->setDateEntered($this->getDateEntered());
        $copyObj->setEnteredBy($this->getEnteredBy());
        $copyObj->setEditedBy($this->getEditedBy());
        $copyObj->setFriendDate($this->getFriendDate());
        $copyObj->setFlags($this->getFlags());
        $copyObj->setFacebookID($this->getFacebookID());
        $copyObj->setTwitter($this->getTwitter());
        $copyObj->setLinkedIn($this->getLinkedIn());
        $copyObj->setDateDeactivated($this->getDateDeactivated());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            $relObj = $this->getPersonCustom();
            if ($relObj) {
                $copyObj->setPersonCustom($relObj->copy($deepCopy));
            }

            foreach ($this->getNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNoteShares() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNoteShare($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPerson2group2roleP2g2rs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPerson2group2roleP2g2r($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAutoPayments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAutoPayment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEventAttends() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventAttend($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPledges() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPledge($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getUser();
            if ($relObj) {
                $copyObj->setUser($relObj->copy($deepCopy));
            }

            foreach ($this->getPersonVolunteerOpportunities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersonVolunteerOpportunity($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGroupManagerpeople() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGroupManagerPerson($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCKEditorTemplatess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCKEditorTemplates($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPastoralCaresRelatedByPastorId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPastoralCareRelatedByPastorId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPastoralCaresRelatedByPersonId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPastoralCareRelatedByPersonId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMenuLinks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMenuLink($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \EcclesiaCRM\Person Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildFamily object.
     *
     * @param  ChildFamily $v
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFamily(ChildFamily $v = null)
    {
        if ($v === null) {
            $this->setFamId(0);
        } else {
            $this->setFamId($v->getId());
        }

        $this->aFamily = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFamily object, it will not be re-added.
        if ($v !== null) {
            $v->addPerson($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFamily object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFamily The associated ChildFamily object.
     * @throws PropelException
     */
    public function getFamily(ConnectionInterface $con = null)
    {
        if ($this->aFamily === null && ($this->per_fam_id != 0)) {
            $this->aFamily = ChildFamilyQuery::create()->findPk($this->per_fam_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFamily->addPeople($this);
             */
        }

        return $this->aFamily;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Note' == $relationName) {
            $this->initNotes();
            return;
        }
        if ('NoteShare' == $relationName) {
            $this->initNoteShares();
            return;
        }
        if ('Person2group2roleP2g2r' == $relationName) {
            $this->initPerson2group2roleP2g2rs();
            return;
        }
        if ('AutoPayment' == $relationName) {
            $this->initAutoPayments();
            return;
        }
        if ('EventAttend' == $relationName) {
            $this->initEventAttends();
            return;
        }
        if ('Pledge' == $relationName) {
            $this->initPledges();
            return;
        }
        if ('PersonVolunteerOpportunity' == $relationName) {
            $this->initPersonVolunteerOpportunities();
            return;
        }
        if ('GroupManagerPerson' == $relationName) {
            $this->initGroupManagerpeople();
            return;
        }
        if ('CKEditorTemplates' == $relationName) {
            $this->initCKEditorTemplatess();
            return;
        }
        if ('PastoralCareRelatedByPastorId' == $relationName) {
            $this->initPastoralCaresRelatedByPastorId();
            return;
        }
        if ('PastoralCareRelatedByPersonId' == $relationName) {
            $this->initPastoralCaresRelatedByPersonId();
            return;
        }
        if ('MenuLink' == $relationName) {
            $this->initMenuLinks();
            return;
        }
    }

    /**
     * Gets a single ChildPersonCustom object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildPersonCustom
     * @throws PropelException
     */
    public function getPersonCustom(ConnectionInterface $con = null)
    {

        if ($this->singlePersonCustom === null && !$this->isNew()) {
            $this->singlePersonCustom = ChildPersonCustomQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singlePersonCustom;
    }

    /**
     * Sets a single ChildPersonCustom object as related to this object by a one-to-one relationship.
     *
     * @param  ChildPersonCustom $v ChildPersonCustom
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPersonCustom(ChildPersonCustom $v = null)
    {
        $this->singlePersonCustom = $v;

        // Make sure that that the passed-in ChildPersonCustom isn't already associated with this object
        if ($v !== null && $v->getPerson(null, false) === null) {
            $v->setPerson($this);
        }

        return $this;
    }

    /**
     * Clears out the collNotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNotes()
     */
    public function clearNotes()
    {
        $this->collNotes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNotes collection loaded partially.
     */
    public function resetPartialNotes($v = true)
    {
        $this->collNotesPartial = $v;
    }

    /**
     * Initializes the collNotes collection.
     *
     * By default this just sets the collNotes collection to an empty array (like clearcollNotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNotes($overrideExisting = true)
    {
        if (null !== $this->collNotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = NoteTableMap::getTableMap()->getCollectionClassName();

        $this->collNotes = new $collectionClassName;
        $this->collNotes->setModel('\EcclesiaCRM\Note');
    }

    /**
     * Gets an array of ChildNote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNote[] List of ChildNote objects
     * @throws PropelException
     */
    public function getNotes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNotesPartial && !$this->isNew();
        if (null === $this->collNotes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNotes) {
                // return empty collection
                $this->initNotes();
            } else {
                $collNotes = ChildNoteQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNotesPartial && count($collNotes)) {
                        $this->initNotes(false);

                        foreach ($collNotes as $obj) {
                            if (false == $this->collNotes->contains($obj)) {
                                $this->collNotes->append($obj);
                            }
                        }

                        $this->collNotesPartial = true;
                    }

                    return $collNotes;
                }

                if ($partial && $this->collNotes) {
                    foreach ($this->collNotes as $obj) {
                        if ($obj->isNew()) {
                            $collNotes[] = $obj;
                        }
                    }
                }

                $this->collNotes = $collNotes;
                $this->collNotesPartial = false;
            }
        }

        return $this->collNotes;
    }

    /**
     * Sets a collection of ChildNote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $notes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setNotes(Collection $notes, ConnectionInterface $con = null)
    {
        /** @var ChildNote[] $notesToDelete */
        $notesToDelete = $this->getNotes(new Criteria(), $con)->diff($notes);


        $this->notesScheduledForDeletion = $notesToDelete;

        foreach ($notesToDelete as $noteRemoved) {
            $noteRemoved->setPerson(null);
        }

        $this->collNotes = null;
        foreach ($notes as $note) {
            $this->addNote($note);
        }

        $this->collNotes = $notes;
        $this->collNotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Note objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Note objects.
     * @throws PropelException
     */
    public function countNotes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNotesPartial && !$this->isNew();
        if (null === $this->collNotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNotes());
            }

            $query = ChildNoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collNotes);
    }

    /**
     * Method called to associate a ChildNote object to this object
     * through the ChildNote foreign key attribute.
     *
     * @param  ChildNote $l ChildNote
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addNote(ChildNote $l)
    {
        if ($this->collNotes === null) {
            $this->initNotes();
            $this->collNotesPartial = true;
        }

        if (!$this->collNotes->contains($l)) {
            $this->doAddNote($l);

            if ($this->notesScheduledForDeletion and $this->notesScheduledForDeletion->contains($l)) {
                $this->notesScheduledForDeletion->remove($this->notesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNote $note The ChildNote object to add.
     */
    protected function doAddNote(ChildNote $note)
    {
        $this->collNotes[]= $note;
        $note->setPerson($this);
    }

    /**
     * @param  ChildNote $note The ChildNote object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeNote(ChildNote $note)
    {
        if ($this->getNotes()->contains($note)) {
            $pos = $this->collNotes->search($note);
            $this->collNotes->remove($pos);
            if (null === $this->notesScheduledForDeletion) {
                $this->notesScheduledForDeletion = clone $this->collNotes;
                $this->notesScheduledForDeletion->clear();
            }
            $this->notesScheduledForDeletion[]= clone $note;
            $note->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Notes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNote[] List of ChildNote objects
     */
    public function getNotesJoinFamily(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNoteQuery::create(null, $criteria);
        $query->joinWith('Family', $joinBehavior);

        return $this->getNotes($query, $con);
    }

    /**
     * Clears out the collNoteShares collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNoteShares()
     */
    public function clearNoteShares()
    {
        $this->collNoteShares = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNoteShares collection loaded partially.
     */
    public function resetPartialNoteShares($v = true)
    {
        $this->collNoteSharesPartial = $v;
    }

    /**
     * Initializes the collNoteShares collection.
     *
     * By default this just sets the collNoteShares collection to an empty array (like clearcollNoteShares());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNoteShares($overrideExisting = true)
    {
        if (null !== $this->collNoteShares && !$overrideExisting) {
            return;
        }

        $collectionClassName = NoteShareTableMap::getTableMap()->getCollectionClassName();

        $this->collNoteShares = new $collectionClassName;
        $this->collNoteShares->setModel('\EcclesiaCRM\NoteShare');
    }

    /**
     * Gets an array of ChildNoteShare objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNoteShare[] List of ChildNoteShare objects
     * @throws PropelException
     */
    public function getNoteShares(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNoteSharesPartial && !$this->isNew();
        if (null === $this->collNoteShares || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNoteShares) {
                // return empty collection
                $this->initNoteShares();
            } else {
                $collNoteShares = ChildNoteShareQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNoteSharesPartial && count($collNoteShares)) {
                        $this->initNoteShares(false);

                        foreach ($collNoteShares as $obj) {
                            if (false == $this->collNoteShares->contains($obj)) {
                                $this->collNoteShares->append($obj);
                            }
                        }

                        $this->collNoteSharesPartial = true;
                    }

                    return $collNoteShares;
                }

                if ($partial && $this->collNoteShares) {
                    foreach ($this->collNoteShares as $obj) {
                        if ($obj->isNew()) {
                            $collNoteShares[] = $obj;
                        }
                    }
                }

                $this->collNoteShares = $collNoteShares;
                $this->collNoteSharesPartial = false;
            }
        }

        return $this->collNoteShares;
    }

    /**
     * Sets a collection of ChildNoteShare objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $noteShares A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setNoteShares(Collection $noteShares, ConnectionInterface $con = null)
    {
        /** @var ChildNoteShare[] $noteSharesToDelete */
        $noteSharesToDelete = $this->getNoteShares(new Criteria(), $con)->diff($noteShares);


        $this->noteSharesScheduledForDeletion = $noteSharesToDelete;

        foreach ($noteSharesToDelete as $noteShareRemoved) {
            $noteShareRemoved->setPerson(null);
        }

        $this->collNoteShares = null;
        foreach ($noteShares as $noteShare) {
            $this->addNoteShare($noteShare);
        }

        $this->collNoteShares = $noteShares;
        $this->collNoteSharesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NoteShare objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related NoteShare objects.
     * @throws PropelException
     */
    public function countNoteShares(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNoteSharesPartial && !$this->isNew();
        if (null === $this->collNoteShares || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNoteShares) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNoteShares());
            }

            $query = ChildNoteShareQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collNoteShares);
    }

    /**
     * Method called to associate a ChildNoteShare object to this object
     * through the ChildNoteShare foreign key attribute.
     *
     * @param  ChildNoteShare $l ChildNoteShare
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addNoteShare(ChildNoteShare $l)
    {
        if ($this->collNoteShares === null) {
            $this->initNoteShares();
            $this->collNoteSharesPartial = true;
        }

        if (!$this->collNoteShares->contains($l)) {
            $this->doAddNoteShare($l);

            if ($this->noteSharesScheduledForDeletion and $this->noteSharesScheduledForDeletion->contains($l)) {
                $this->noteSharesScheduledForDeletion->remove($this->noteSharesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNoteShare $noteShare The ChildNoteShare object to add.
     */
    protected function doAddNoteShare(ChildNoteShare $noteShare)
    {
        $this->collNoteShares[]= $noteShare;
        $noteShare->setPerson($this);
    }

    /**
     * @param  ChildNoteShare $noteShare The ChildNoteShare object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeNoteShare(ChildNoteShare $noteShare)
    {
        if ($this->getNoteShares()->contains($noteShare)) {
            $pos = $this->collNoteShares->search($noteShare);
            $this->collNoteShares->remove($pos);
            if (null === $this->noteSharesScheduledForDeletion) {
                $this->noteSharesScheduledForDeletion = clone $this->collNoteShares;
                $this->noteSharesScheduledForDeletion->clear();
            }
            $this->noteSharesScheduledForDeletion[]= $noteShare;
            $noteShare->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related NoteShares from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNoteShare[] List of ChildNoteShare objects
     */
    public function getNoteSharesJoinNote(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNoteShareQuery::create(null, $criteria);
        $query->joinWith('Note', $joinBehavior);

        return $this->getNoteShares($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related NoteShares from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNoteShare[] List of ChildNoteShare objects
     */
    public function getNoteSharesJoinFamily(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNoteShareQuery::create(null, $criteria);
        $query->joinWith('Family', $joinBehavior);

        return $this->getNoteShares($query, $con);
    }

    /**
     * Clears out the collPerson2group2roleP2g2rs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPerson2group2roleP2g2rs()
     */
    public function clearPerson2group2roleP2g2rs()
    {
        $this->collPerson2group2roleP2g2rs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPerson2group2roleP2g2rs collection loaded partially.
     */
    public function resetPartialPerson2group2roleP2g2rs($v = true)
    {
        $this->collPerson2group2roleP2g2rsPartial = $v;
    }

    /**
     * Initializes the collPerson2group2roleP2g2rs collection.
     *
     * By default this just sets the collPerson2group2roleP2g2rs collection to an empty array (like clearcollPerson2group2roleP2g2rs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPerson2group2roleP2g2rs($overrideExisting = true)
    {
        if (null !== $this->collPerson2group2roleP2g2rs && !$overrideExisting) {
            return;
        }

        $collectionClassName = Person2group2roleP2g2rTableMap::getTableMap()->getCollectionClassName();

        $this->collPerson2group2roleP2g2rs = new $collectionClassName;
        $this->collPerson2group2roleP2g2rs->setModel('\EcclesiaCRM\Person2group2roleP2g2r');
    }

    /**
     * Gets an array of ChildPerson2group2roleP2g2r objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPerson2group2roleP2g2r[] List of ChildPerson2group2roleP2g2r objects
     * @throws PropelException
     */
    public function getPerson2group2roleP2g2rs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPerson2group2roleP2g2rsPartial && !$this->isNew();
        if (null === $this->collPerson2group2roleP2g2rs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPerson2group2roleP2g2rs) {
                // return empty collection
                $this->initPerson2group2roleP2g2rs();
            } else {
                $collPerson2group2roleP2g2rs = ChildPerson2group2roleP2g2rQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPerson2group2roleP2g2rsPartial && count($collPerson2group2roleP2g2rs)) {
                        $this->initPerson2group2roleP2g2rs(false);

                        foreach ($collPerson2group2roleP2g2rs as $obj) {
                            if (false == $this->collPerson2group2roleP2g2rs->contains($obj)) {
                                $this->collPerson2group2roleP2g2rs->append($obj);
                            }
                        }

                        $this->collPerson2group2roleP2g2rsPartial = true;
                    }

                    return $collPerson2group2roleP2g2rs;
                }

                if ($partial && $this->collPerson2group2roleP2g2rs) {
                    foreach ($this->collPerson2group2roleP2g2rs as $obj) {
                        if ($obj->isNew()) {
                            $collPerson2group2roleP2g2rs[] = $obj;
                        }
                    }
                }

                $this->collPerson2group2roleP2g2rs = $collPerson2group2roleP2g2rs;
                $this->collPerson2group2roleP2g2rsPartial = false;
            }
        }

        return $this->collPerson2group2roleP2g2rs;
    }

    /**
     * Sets a collection of ChildPerson2group2roleP2g2r objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $person2group2roleP2g2rs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setPerson2group2roleP2g2rs(Collection $person2group2roleP2g2rs, ConnectionInterface $con = null)
    {
        /** @var ChildPerson2group2roleP2g2r[] $person2group2roleP2g2rsToDelete */
        $person2group2roleP2g2rsToDelete = $this->getPerson2group2roleP2g2rs(new Criteria(), $con)->diff($person2group2roleP2g2rs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->person2group2roleP2g2rsScheduledForDeletion = clone $person2group2roleP2g2rsToDelete;

        foreach ($person2group2roleP2g2rsToDelete as $person2group2roleP2g2rRemoved) {
            $person2group2roleP2g2rRemoved->setPerson(null);
        }

        $this->collPerson2group2roleP2g2rs = null;
        foreach ($person2group2roleP2g2rs as $person2group2roleP2g2r) {
            $this->addPerson2group2roleP2g2r($person2group2roleP2g2r);
        }

        $this->collPerson2group2roleP2g2rs = $person2group2roleP2g2rs;
        $this->collPerson2group2roleP2g2rsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Person2group2roleP2g2r objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Person2group2roleP2g2r objects.
     * @throws PropelException
     */
    public function countPerson2group2roleP2g2rs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPerson2group2roleP2g2rsPartial && !$this->isNew();
        if (null === $this->collPerson2group2roleP2g2rs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPerson2group2roleP2g2rs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPerson2group2roleP2g2rs());
            }

            $query = ChildPerson2group2roleP2g2rQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collPerson2group2roleP2g2rs);
    }

    /**
     * Method called to associate a ChildPerson2group2roleP2g2r object to this object
     * through the ChildPerson2group2roleP2g2r foreign key attribute.
     *
     * @param  ChildPerson2group2roleP2g2r $l ChildPerson2group2roleP2g2r
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addPerson2group2roleP2g2r(ChildPerson2group2roleP2g2r $l)
    {
        if ($this->collPerson2group2roleP2g2rs === null) {
            $this->initPerson2group2roleP2g2rs();
            $this->collPerson2group2roleP2g2rsPartial = true;
        }

        if (!$this->collPerson2group2roleP2g2rs->contains($l)) {
            $this->doAddPerson2group2roleP2g2r($l);

            if ($this->person2group2roleP2g2rsScheduledForDeletion and $this->person2group2roleP2g2rsScheduledForDeletion->contains($l)) {
                $this->person2group2roleP2g2rsScheduledForDeletion->remove($this->person2group2roleP2g2rsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPerson2group2roleP2g2r $person2group2roleP2g2r The ChildPerson2group2roleP2g2r object to add.
     */
    protected function doAddPerson2group2roleP2g2r(ChildPerson2group2roleP2g2r $person2group2roleP2g2r)
    {
        $this->collPerson2group2roleP2g2rs[]= $person2group2roleP2g2r;
        $person2group2roleP2g2r->setPerson($this);
    }

    /**
     * @param  ChildPerson2group2roleP2g2r $person2group2roleP2g2r The ChildPerson2group2roleP2g2r object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removePerson2group2roleP2g2r(ChildPerson2group2roleP2g2r $person2group2roleP2g2r)
    {
        if ($this->getPerson2group2roleP2g2rs()->contains($person2group2roleP2g2r)) {
            $pos = $this->collPerson2group2roleP2g2rs->search($person2group2roleP2g2r);
            $this->collPerson2group2roleP2g2rs->remove($pos);
            if (null === $this->person2group2roleP2g2rsScheduledForDeletion) {
                $this->person2group2roleP2g2rsScheduledForDeletion = clone $this->collPerson2group2roleP2g2rs;
                $this->person2group2roleP2g2rsScheduledForDeletion->clear();
            }
            $this->person2group2roleP2g2rsScheduledForDeletion[]= clone $person2group2roleP2g2r;
            $person2group2roleP2g2r->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Person2group2roleP2g2rs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPerson2group2roleP2g2r[] List of ChildPerson2group2roleP2g2r objects
     */
    public function getPerson2group2roleP2g2rsJoinGroup(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPerson2group2roleP2g2rQuery::create(null, $criteria);
        $query->joinWith('Group', $joinBehavior);

        return $this->getPerson2group2roleP2g2rs($query, $con);
    }

    /**
     * Clears out the collAutoPayments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAutoPayments()
     */
    public function clearAutoPayments()
    {
        $this->collAutoPayments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAutoPayments collection loaded partially.
     */
    public function resetPartialAutoPayments($v = true)
    {
        $this->collAutoPaymentsPartial = $v;
    }

    /**
     * Initializes the collAutoPayments collection.
     *
     * By default this just sets the collAutoPayments collection to an empty array (like clearcollAutoPayments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAutoPayments($overrideExisting = true)
    {
        if (null !== $this->collAutoPayments && !$overrideExisting) {
            return;
        }

        $collectionClassName = AutoPaymentTableMap::getTableMap()->getCollectionClassName();

        $this->collAutoPayments = new $collectionClassName;
        $this->collAutoPayments->setModel('\EcclesiaCRM\AutoPayment');
    }

    /**
     * Gets an array of ChildAutoPayment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAutoPayment[] List of ChildAutoPayment objects
     * @throws PropelException
     */
    public function getAutoPayments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAutoPaymentsPartial && !$this->isNew();
        if (null === $this->collAutoPayments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAutoPayments) {
                // return empty collection
                $this->initAutoPayments();
            } else {
                $collAutoPayments = ChildAutoPaymentQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAutoPaymentsPartial && count($collAutoPayments)) {
                        $this->initAutoPayments(false);

                        foreach ($collAutoPayments as $obj) {
                            if (false == $this->collAutoPayments->contains($obj)) {
                                $this->collAutoPayments->append($obj);
                            }
                        }

                        $this->collAutoPaymentsPartial = true;
                    }

                    return $collAutoPayments;
                }

                if ($partial && $this->collAutoPayments) {
                    foreach ($this->collAutoPayments as $obj) {
                        if ($obj->isNew()) {
                            $collAutoPayments[] = $obj;
                        }
                    }
                }

                $this->collAutoPayments = $collAutoPayments;
                $this->collAutoPaymentsPartial = false;
            }
        }

        return $this->collAutoPayments;
    }

    /**
     * Sets a collection of ChildAutoPayment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $autoPayments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setAutoPayments(Collection $autoPayments, ConnectionInterface $con = null)
    {
        /** @var ChildAutoPayment[] $autoPaymentsToDelete */
        $autoPaymentsToDelete = $this->getAutoPayments(new Criteria(), $con)->diff($autoPayments);


        $this->autoPaymentsScheduledForDeletion = $autoPaymentsToDelete;

        foreach ($autoPaymentsToDelete as $autoPaymentRemoved) {
            $autoPaymentRemoved->setPerson(null);
        }

        $this->collAutoPayments = null;
        foreach ($autoPayments as $autoPayment) {
            $this->addAutoPayment($autoPayment);
        }

        $this->collAutoPayments = $autoPayments;
        $this->collAutoPaymentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AutoPayment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related AutoPayment objects.
     * @throws PropelException
     */
    public function countAutoPayments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAutoPaymentsPartial && !$this->isNew();
        if (null === $this->collAutoPayments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAutoPayments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAutoPayments());
            }

            $query = ChildAutoPaymentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collAutoPayments);
    }

    /**
     * Method called to associate a ChildAutoPayment object to this object
     * through the ChildAutoPayment foreign key attribute.
     *
     * @param  ChildAutoPayment $l ChildAutoPayment
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addAutoPayment(ChildAutoPayment $l)
    {
        if ($this->collAutoPayments === null) {
            $this->initAutoPayments();
            $this->collAutoPaymentsPartial = true;
        }

        if (!$this->collAutoPayments->contains($l)) {
            $this->doAddAutoPayment($l);

            if ($this->autoPaymentsScheduledForDeletion and $this->autoPaymentsScheduledForDeletion->contains($l)) {
                $this->autoPaymentsScheduledForDeletion->remove($this->autoPaymentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAutoPayment $autoPayment The ChildAutoPayment object to add.
     */
    protected function doAddAutoPayment(ChildAutoPayment $autoPayment)
    {
        $this->collAutoPayments[]= $autoPayment;
        $autoPayment->setPerson($this);
    }

    /**
     * @param  ChildAutoPayment $autoPayment The ChildAutoPayment object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeAutoPayment(ChildAutoPayment $autoPayment)
    {
        if ($this->getAutoPayments()->contains($autoPayment)) {
            $pos = $this->collAutoPayments->search($autoPayment);
            $this->collAutoPayments->remove($pos);
            if (null === $this->autoPaymentsScheduledForDeletion) {
                $this->autoPaymentsScheduledForDeletion = clone $this->collAutoPayments;
                $this->autoPaymentsScheduledForDeletion->clear();
            }
            $this->autoPaymentsScheduledForDeletion[]= $autoPayment;
            $autoPayment->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related AutoPayments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAutoPayment[] List of ChildAutoPayment objects
     */
    public function getAutoPaymentsJoinFamily(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAutoPaymentQuery::create(null, $criteria);
        $query->joinWith('Family', $joinBehavior);

        return $this->getAutoPayments($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related AutoPayments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAutoPayment[] List of ChildAutoPayment objects
     */
    public function getAutoPaymentsJoinDonationFund(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAutoPaymentQuery::create(null, $criteria);
        $query->joinWith('DonationFund', $joinBehavior);

        return $this->getAutoPayments($query, $con);
    }

    /**
     * Clears out the collEventAttends collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEventAttends()
     */
    public function clearEventAttends()
    {
        $this->collEventAttends = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEventAttends collection loaded partially.
     */
    public function resetPartialEventAttends($v = true)
    {
        $this->collEventAttendsPartial = $v;
    }

    /**
     * Initializes the collEventAttends collection.
     *
     * By default this just sets the collEventAttends collection to an empty array (like clearcollEventAttends());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventAttends($overrideExisting = true)
    {
        if (null !== $this->collEventAttends && !$overrideExisting) {
            return;
        }

        $collectionClassName = EventAttendTableMap::getTableMap()->getCollectionClassName();

        $this->collEventAttends = new $collectionClassName;
        $this->collEventAttends->setModel('\EcclesiaCRM\EventAttend');
    }

    /**
     * Gets an array of ChildEventAttend objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEventAttend[] List of ChildEventAttend objects
     * @throws PropelException
     */
    public function getEventAttends(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEventAttendsPartial && !$this->isNew();
        if (null === $this->collEventAttends || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEventAttends) {
                // return empty collection
                $this->initEventAttends();
            } else {
                $collEventAttends = ChildEventAttendQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEventAttendsPartial && count($collEventAttends)) {
                        $this->initEventAttends(false);

                        foreach ($collEventAttends as $obj) {
                            if (false == $this->collEventAttends->contains($obj)) {
                                $this->collEventAttends->append($obj);
                            }
                        }

                        $this->collEventAttendsPartial = true;
                    }

                    return $collEventAttends;
                }

                if ($partial && $this->collEventAttends) {
                    foreach ($this->collEventAttends as $obj) {
                        if ($obj->isNew()) {
                            $collEventAttends[] = $obj;
                        }
                    }
                }

                $this->collEventAttends = $collEventAttends;
                $this->collEventAttendsPartial = false;
            }
        }

        return $this->collEventAttends;
    }

    /**
     * Sets a collection of ChildEventAttend objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $eventAttends A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setEventAttends(Collection $eventAttends, ConnectionInterface $con = null)
    {
        /** @var ChildEventAttend[] $eventAttendsToDelete */
        $eventAttendsToDelete = $this->getEventAttends(new Criteria(), $con)->diff($eventAttends);


        $this->eventAttendsScheduledForDeletion = $eventAttendsToDelete;

        foreach ($eventAttendsToDelete as $eventAttendRemoved) {
            $eventAttendRemoved->setPerson(null);
        }

        $this->collEventAttends = null;
        foreach ($eventAttends as $eventAttend) {
            $this->addEventAttend($eventAttend);
        }

        $this->collEventAttends = $eventAttends;
        $this->collEventAttendsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EventAttend objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related EventAttend objects.
     * @throws PropelException
     */
    public function countEventAttends(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEventAttendsPartial && !$this->isNew();
        if (null === $this->collEventAttends || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventAttends) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEventAttends());
            }

            $query = ChildEventAttendQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collEventAttends);
    }

    /**
     * Method called to associate a ChildEventAttend object to this object
     * through the ChildEventAttend foreign key attribute.
     *
     * @param  ChildEventAttend $l ChildEventAttend
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addEventAttend(ChildEventAttend $l)
    {
        if ($this->collEventAttends === null) {
            $this->initEventAttends();
            $this->collEventAttendsPartial = true;
        }

        if (!$this->collEventAttends->contains($l)) {
            $this->doAddEventAttend($l);

            if ($this->eventAttendsScheduledForDeletion and $this->eventAttendsScheduledForDeletion->contains($l)) {
                $this->eventAttendsScheduledForDeletion->remove($this->eventAttendsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEventAttend $eventAttend The ChildEventAttend object to add.
     */
    protected function doAddEventAttend(ChildEventAttend $eventAttend)
    {
        $this->collEventAttends[]= $eventAttend;
        $eventAttend->setPerson($this);
    }

    /**
     * @param  ChildEventAttend $eventAttend The ChildEventAttend object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeEventAttend(ChildEventAttend $eventAttend)
    {
        if ($this->getEventAttends()->contains($eventAttend)) {
            $pos = $this->collEventAttends->search($eventAttend);
            $this->collEventAttends->remove($pos);
            if (null === $this->eventAttendsScheduledForDeletion) {
                $this->eventAttendsScheduledForDeletion = clone $this->collEventAttends;
                $this->eventAttendsScheduledForDeletion->clear();
            }
            $this->eventAttendsScheduledForDeletion[]= clone $eventAttend;
            $eventAttend->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related EventAttends from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEventAttend[] List of ChildEventAttend objects
     */
    public function getEventAttendsJoinEvent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEventAttendQuery::create(null, $criteria);
        $query->joinWith('Event', $joinBehavior);

        return $this->getEventAttends($query, $con);
    }

    /**
     * Clears out the collPledges collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPledges()
     */
    public function clearPledges()
    {
        $this->collPledges = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPledges collection loaded partially.
     */
    public function resetPartialPledges($v = true)
    {
        $this->collPledgesPartial = $v;
    }

    /**
     * Initializes the collPledges collection.
     *
     * By default this just sets the collPledges collection to an empty array (like clearcollPledges());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPledges($overrideExisting = true)
    {
        if (null !== $this->collPledges && !$overrideExisting) {
            return;
        }

        $collectionClassName = PledgeTableMap::getTableMap()->getCollectionClassName();

        $this->collPledges = new $collectionClassName;
        $this->collPledges->setModel('\EcclesiaCRM\Pledge');
    }

    /**
     * Gets an array of ChildPledge objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     * @throws PropelException
     */
    public function getPledges(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPledgesPartial && !$this->isNew();
        if (null === $this->collPledges || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPledges) {
                // return empty collection
                $this->initPledges();
            } else {
                $collPledges = ChildPledgeQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPledgesPartial && count($collPledges)) {
                        $this->initPledges(false);

                        foreach ($collPledges as $obj) {
                            if (false == $this->collPledges->contains($obj)) {
                                $this->collPledges->append($obj);
                            }
                        }

                        $this->collPledgesPartial = true;
                    }

                    return $collPledges;
                }

                if ($partial && $this->collPledges) {
                    foreach ($this->collPledges as $obj) {
                        if ($obj->isNew()) {
                            $collPledges[] = $obj;
                        }
                    }
                }

                $this->collPledges = $collPledges;
                $this->collPledgesPartial = false;
            }
        }

        return $this->collPledges;
    }

    /**
     * Sets a collection of ChildPledge objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pledges A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setPledges(Collection $pledges, ConnectionInterface $con = null)
    {
        /** @var ChildPledge[] $pledgesToDelete */
        $pledgesToDelete = $this->getPledges(new Criteria(), $con)->diff($pledges);


        $this->pledgesScheduledForDeletion = $pledgesToDelete;

        foreach ($pledgesToDelete as $pledgeRemoved) {
            $pledgeRemoved->setPerson(null);
        }

        $this->collPledges = null;
        foreach ($pledges as $pledge) {
            $this->addPledge($pledge);
        }

        $this->collPledges = $pledges;
        $this->collPledgesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pledge objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Pledge objects.
     * @throws PropelException
     */
    public function countPledges(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPledgesPartial && !$this->isNew();
        if (null === $this->collPledges || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPledges) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPledges());
            }

            $query = ChildPledgeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collPledges);
    }

    /**
     * Method called to associate a ChildPledge object to this object
     * through the ChildPledge foreign key attribute.
     *
     * @param  ChildPledge $l ChildPledge
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addPledge(ChildPledge $l)
    {
        if ($this->collPledges === null) {
            $this->initPledges();
            $this->collPledgesPartial = true;
        }

        if (!$this->collPledges->contains($l)) {
            $this->doAddPledge($l);

            if ($this->pledgesScheduledForDeletion and $this->pledgesScheduledForDeletion->contains($l)) {
                $this->pledgesScheduledForDeletion->remove($this->pledgesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPledge $pledge The ChildPledge object to add.
     */
    protected function doAddPledge(ChildPledge $pledge)
    {
        $this->collPledges[]= $pledge;
        $pledge->setPerson($this);
    }

    /**
     * @param  ChildPledge $pledge The ChildPledge object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removePledge(ChildPledge $pledge)
    {
        if ($this->getPledges()->contains($pledge)) {
            $pos = $this->collPledges->search($pledge);
            $this->collPledges->remove($pos);
            if (null === $this->pledgesScheduledForDeletion) {
                $this->pledgesScheduledForDeletion = clone $this->collPledges;
                $this->pledgesScheduledForDeletion->clear();
            }
            $this->pledgesScheduledForDeletion[]= clone $pledge;
            $pledge->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinDeposit(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('Deposit', $joinBehavior);

        return $this->getPledges($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinDonationFund(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('DonationFund', $joinBehavior);

        return $this->getPledges($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinFamily(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('Family', $joinBehavior);

        return $this->getPledges($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinAutoPayment(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('AutoPayment', $joinBehavior);

        return $this->getPledges($query, $con);
    }

    /**
     * Gets a single ChildUser object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildUser
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {

        if ($this->singleUser === null && !$this->isNew()) {
            $this->singleUser = ChildUserQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleUser;
    }

    /**
     * Sets a single ChildUser object as related to this object by a one-to-one relationship.
     *
     * @param  ChildUser $v ChildUser
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        $this->singleUser = $v;

        // Make sure that that the passed-in ChildUser isn't already associated with this object
        if ($v !== null && $v->getPerson(null, false) === null) {
            $v->setPerson($this);
        }

        return $this;
    }

    /**
     * Clears out the collPersonVolunteerOpportunities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersonVolunteerOpportunities()
     */
    public function clearPersonVolunteerOpportunities()
    {
        $this->collPersonVolunteerOpportunities = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersonVolunteerOpportunities collection loaded partially.
     */
    public function resetPartialPersonVolunteerOpportunities($v = true)
    {
        $this->collPersonVolunteerOpportunitiesPartial = $v;
    }

    /**
     * Initializes the collPersonVolunteerOpportunities collection.
     *
     * By default this just sets the collPersonVolunteerOpportunities collection to an empty array (like clearcollPersonVolunteerOpportunities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersonVolunteerOpportunities($overrideExisting = true)
    {
        if (null !== $this->collPersonVolunteerOpportunities && !$overrideExisting) {
            return;
        }

        $collectionClassName = PersonVolunteerOpportunityTableMap::getTableMap()->getCollectionClassName();

        $this->collPersonVolunteerOpportunities = new $collectionClassName;
        $this->collPersonVolunteerOpportunities->setModel('\EcclesiaCRM\PersonVolunteerOpportunity');
    }

    /**
     * Gets an array of ChildPersonVolunteerOpportunity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersonVolunteerOpportunity[] List of ChildPersonVolunteerOpportunity objects
     * @throws PropelException
     */
    public function getPersonVolunteerOpportunities(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonVolunteerOpportunitiesPartial && !$this->isNew();
        if (null === $this->collPersonVolunteerOpportunities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersonVolunteerOpportunities) {
                // return empty collection
                $this->initPersonVolunteerOpportunities();
            } else {
                $collPersonVolunteerOpportunities = ChildPersonVolunteerOpportunityQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersonVolunteerOpportunitiesPartial && count($collPersonVolunteerOpportunities)) {
                        $this->initPersonVolunteerOpportunities(false);

                        foreach ($collPersonVolunteerOpportunities as $obj) {
                            if (false == $this->collPersonVolunteerOpportunities->contains($obj)) {
                                $this->collPersonVolunteerOpportunities->append($obj);
                            }
                        }

                        $this->collPersonVolunteerOpportunitiesPartial = true;
                    }

                    return $collPersonVolunteerOpportunities;
                }

                if ($partial && $this->collPersonVolunteerOpportunities) {
                    foreach ($this->collPersonVolunteerOpportunities as $obj) {
                        if ($obj->isNew()) {
                            $collPersonVolunteerOpportunities[] = $obj;
                        }
                    }
                }

                $this->collPersonVolunteerOpportunities = $collPersonVolunteerOpportunities;
                $this->collPersonVolunteerOpportunitiesPartial = false;
            }
        }

        return $this->collPersonVolunteerOpportunities;
    }

    /**
     * Sets a collection of ChildPersonVolunteerOpportunity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $personVolunteerOpportunities A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setPersonVolunteerOpportunities(Collection $personVolunteerOpportunities, ConnectionInterface $con = null)
    {
        /** @var ChildPersonVolunteerOpportunity[] $personVolunteerOpportunitiesToDelete */
        $personVolunteerOpportunitiesToDelete = $this->getPersonVolunteerOpportunities(new Criteria(), $con)->diff($personVolunteerOpportunities);


        $this->personVolunteerOpportunitiesScheduledForDeletion = $personVolunteerOpportunitiesToDelete;

        foreach ($personVolunteerOpportunitiesToDelete as $personVolunteerOpportunityRemoved) {
            $personVolunteerOpportunityRemoved->setPerson(null);
        }

        $this->collPersonVolunteerOpportunities = null;
        foreach ($personVolunteerOpportunities as $personVolunteerOpportunity) {
            $this->addPersonVolunteerOpportunity($personVolunteerOpportunity);
        }

        $this->collPersonVolunteerOpportunities = $personVolunteerOpportunities;
        $this->collPersonVolunteerOpportunitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PersonVolunteerOpportunity objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PersonVolunteerOpportunity objects.
     * @throws PropelException
     */
    public function countPersonVolunteerOpportunities(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonVolunteerOpportunitiesPartial && !$this->isNew();
        if (null === $this->collPersonVolunteerOpportunities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersonVolunteerOpportunities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersonVolunteerOpportunities());
            }

            $query = ChildPersonVolunteerOpportunityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collPersonVolunteerOpportunities);
    }

    /**
     * Method called to associate a ChildPersonVolunteerOpportunity object to this object
     * through the ChildPersonVolunteerOpportunity foreign key attribute.
     *
     * @param  ChildPersonVolunteerOpportunity $l ChildPersonVolunteerOpportunity
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addPersonVolunteerOpportunity(ChildPersonVolunteerOpportunity $l)
    {
        if ($this->collPersonVolunteerOpportunities === null) {
            $this->initPersonVolunteerOpportunities();
            $this->collPersonVolunteerOpportunitiesPartial = true;
        }

        if (!$this->collPersonVolunteerOpportunities->contains($l)) {
            $this->doAddPersonVolunteerOpportunity($l);

            if ($this->personVolunteerOpportunitiesScheduledForDeletion and $this->personVolunteerOpportunitiesScheduledForDeletion->contains($l)) {
                $this->personVolunteerOpportunitiesScheduledForDeletion->remove($this->personVolunteerOpportunitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersonVolunteerOpportunity $personVolunteerOpportunity The ChildPersonVolunteerOpportunity object to add.
     */
    protected function doAddPersonVolunteerOpportunity(ChildPersonVolunteerOpportunity $personVolunteerOpportunity)
    {
        $this->collPersonVolunteerOpportunities[]= $personVolunteerOpportunity;
        $personVolunteerOpportunity->setPerson($this);
    }

    /**
     * @param  ChildPersonVolunteerOpportunity $personVolunteerOpportunity The ChildPersonVolunteerOpportunity object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removePersonVolunteerOpportunity(ChildPersonVolunteerOpportunity $personVolunteerOpportunity)
    {
        if ($this->getPersonVolunteerOpportunities()->contains($personVolunteerOpportunity)) {
            $pos = $this->collPersonVolunteerOpportunities->search($personVolunteerOpportunity);
            $this->collPersonVolunteerOpportunities->remove($pos);
            if (null === $this->personVolunteerOpportunitiesScheduledForDeletion) {
                $this->personVolunteerOpportunitiesScheduledForDeletion = clone $this->collPersonVolunteerOpportunities;
                $this->personVolunteerOpportunitiesScheduledForDeletion->clear();
            }
            $this->personVolunteerOpportunitiesScheduledForDeletion[]= $personVolunteerOpportunity;
            $personVolunteerOpportunity->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related PersonVolunteerOpportunities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersonVolunteerOpportunity[] List of ChildPersonVolunteerOpportunity objects
     */
    public function getPersonVolunteerOpportunitiesJoinVolunteerOpportunity(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersonVolunteerOpportunityQuery::create(null, $criteria);
        $query->joinWith('VolunteerOpportunity', $joinBehavior);

        return $this->getPersonVolunteerOpportunities($query, $con);
    }

    /**
     * Clears out the collGroupManagerpeople collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGroupManagerpeople()
     */
    public function clearGroupManagerpeople()
    {
        $this->collGroupManagerpeople = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGroupManagerpeople collection loaded partially.
     */
    public function resetPartialGroupManagerpeople($v = true)
    {
        $this->collGroupManagerpeoplePartial = $v;
    }

    /**
     * Initializes the collGroupManagerpeople collection.
     *
     * By default this just sets the collGroupManagerpeople collection to an empty array (like clearcollGroupManagerpeople());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGroupManagerpeople($overrideExisting = true)
    {
        if (null !== $this->collGroupManagerpeople && !$overrideExisting) {
            return;
        }

        $collectionClassName = GroupManagerPersonTableMap::getTableMap()->getCollectionClassName();

        $this->collGroupManagerpeople = new $collectionClassName;
        $this->collGroupManagerpeople->setModel('\EcclesiaCRM\GroupManagerPerson');
    }

    /**
     * Gets an array of ChildGroupManagerPerson objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGroupManagerPerson[] List of ChildGroupManagerPerson objects
     * @throws PropelException
     */
    public function getGroupManagerpeople(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGroupManagerpeoplePartial && !$this->isNew();
        if (null === $this->collGroupManagerpeople || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGroupManagerpeople) {
                // return empty collection
                $this->initGroupManagerpeople();
            } else {
                $collGroupManagerpeople = ChildGroupManagerPersonQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGroupManagerpeoplePartial && count($collGroupManagerpeople)) {
                        $this->initGroupManagerpeople(false);

                        foreach ($collGroupManagerpeople as $obj) {
                            if (false == $this->collGroupManagerpeople->contains($obj)) {
                                $this->collGroupManagerpeople->append($obj);
                            }
                        }

                        $this->collGroupManagerpeoplePartial = true;
                    }

                    return $collGroupManagerpeople;
                }

                if ($partial && $this->collGroupManagerpeople) {
                    foreach ($this->collGroupManagerpeople as $obj) {
                        if ($obj->isNew()) {
                            $collGroupManagerpeople[] = $obj;
                        }
                    }
                }

                $this->collGroupManagerpeople = $collGroupManagerpeople;
                $this->collGroupManagerpeoplePartial = false;
            }
        }

        return $this->collGroupManagerpeople;
    }

    /**
     * Sets a collection of ChildGroupManagerPerson objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $groupManagerpeople A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setGroupManagerpeople(Collection $groupManagerpeople, ConnectionInterface $con = null)
    {
        /** @var ChildGroupManagerPerson[] $groupManagerpeopleToDelete */
        $groupManagerpeopleToDelete = $this->getGroupManagerpeople(new Criteria(), $con)->diff($groupManagerpeople);


        $this->groupManagerpeopleScheduledForDeletion = $groupManagerpeopleToDelete;

        foreach ($groupManagerpeopleToDelete as $groupManagerPersonRemoved) {
            $groupManagerPersonRemoved->setPerson(null);
        }

        $this->collGroupManagerpeople = null;
        foreach ($groupManagerpeople as $groupManagerPerson) {
            $this->addGroupManagerPerson($groupManagerPerson);
        }

        $this->collGroupManagerpeople = $groupManagerpeople;
        $this->collGroupManagerpeoplePartial = false;

        return $this;
    }

    /**
     * Returns the number of related GroupManagerPerson objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related GroupManagerPerson objects.
     * @throws PropelException
     */
    public function countGroupManagerpeople(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGroupManagerpeoplePartial && !$this->isNew();
        if (null === $this->collGroupManagerpeople || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGroupManagerpeople) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGroupManagerpeople());
            }

            $query = ChildGroupManagerPersonQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collGroupManagerpeople);
    }

    /**
     * Method called to associate a ChildGroupManagerPerson object to this object
     * through the ChildGroupManagerPerson foreign key attribute.
     *
     * @param  ChildGroupManagerPerson $l ChildGroupManagerPerson
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addGroupManagerPerson(ChildGroupManagerPerson $l)
    {
        if ($this->collGroupManagerpeople === null) {
            $this->initGroupManagerpeople();
            $this->collGroupManagerpeoplePartial = true;
        }

        if (!$this->collGroupManagerpeople->contains($l)) {
            $this->doAddGroupManagerPerson($l);

            if ($this->groupManagerpeopleScheduledForDeletion and $this->groupManagerpeopleScheduledForDeletion->contains($l)) {
                $this->groupManagerpeopleScheduledForDeletion->remove($this->groupManagerpeopleScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGroupManagerPerson $groupManagerPerson The ChildGroupManagerPerson object to add.
     */
    protected function doAddGroupManagerPerson(ChildGroupManagerPerson $groupManagerPerson)
    {
        $this->collGroupManagerpeople[]= $groupManagerPerson;
        $groupManagerPerson->setPerson($this);
    }

    /**
     * @param  ChildGroupManagerPerson $groupManagerPerson The ChildGroupManagerPerson object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeGroupManagerPerson(ChildGroupManagerPerson $groupManagerPerson)
    {
        if ($this->getGroupManagerpeople()->contains($groupManagerPerson)) {
            $pos = $this->collGroupManagerpeople->search($groupManagerPerson);
            $this->collGroupManagerpeople->remove($pos);
            if (null === $this->groupManagerpeopleScheduledForDeletion) {
                $this->groupManagerpeopleScheduledForDeletion = clone $this->collGroupManagerpeople;
                $this->groupManagerpeopleScheduledForDeletion->clear();
            }
            $this->groupManagerpeopleScheduledForDeletion[]= clone $groupManagerPerson;
            $groupManagerPerson->setPerson(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related GroupManagerpeople from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGroupManagerPerson[] List of ChildGroupManagerPerson objects
     */
    public function getGroupManagerpeopleJoinGroup(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGroupManagerPersonQuery::create(null, $criteria);
        $query->joinWith('Group', $joinBehavior);

        return $this->getGroupManagerpeople($query, $con);
    }

    /**
     * Clears out the collCKEditorTemplatess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCKEditorTemplatess()
     */
    public function clearCKEditorTemplatess()
    {
        $this->collCKEditorTemplatess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCKEditorTemplatess collection loaded partially.
     */
    public function resetPartialCKEditorTemplatess($v = true)
    {
        $this->collCKEditorTemplatessPartial = $v;
    }

    /**
     * Initializes the collCKEditorTemplatess collection.
     *
     * By default this just sets the collCKEditorTemplatess collection to an empty array (like clearcollCKEditorTemplatess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCKEditorTemplatess($overrideExisting = true)
    {
        if (null !== $this->collCKEditorTemplatess && !$overrideExisting) {
            return;
        }

        $collectionClassName = CKEditorTemplatesTableMap::getTableMap()->getCollectionClassName();

        $this->collCKEditorTemplatess = new $collectionClassName;
        $this->collCKEditorTemplatess->setModel('\EcclesiaCRM\CKEditorTemplates');
    }

    /**
     * Gets an array of ChildCKEditorTemplates objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCKEditorTemplates[] List of ChildCKEditorTemplates objects
     * @throws PropelException
     */
    public function getCKEditorTemplatess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCKEditorTemplatessPartial && !$this->isNew();
        if (null === $this->collCKEditorTemplatess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCKEditorTemplatess) {
                // return empty collection
                $this->initCKEditorTemplatess();
            } else {
                $collCKEditorTemplatess = ChildCKEditorTemplatesQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCKEditorTemplatessPartial && count($collCKEditorTemplatess)) {
                        $this->initCKEditorTemplatess(false);

                        foreach ($collCKEditorTemplatess as $obj) {
                            if (false == $this->collCKEditorTemplatess->contains($obj)) {
                                $this->collCKEditorTemplatess->append($obj);
                            }
                        }

                        $this->collCKEditorTemplatessPartial = true;
                    }

                    return $collCKEditorTemplatess;
                }

                if ($partial && $this->collCKEditorTemplatess) {
                    foreach ($this->collCKEditorTemplatess as $obj) {
                        if ($obj->isNew()) {
                            $collCKEditorTemplatess[] = $obj;
                        }
                    }
                }

                $this->collCKEditorTemplatess = $collCKEditorTemplatess;
                $this->collCKEditorTemplatessPartial = false;
            }
        }

        return $this->collCKEditorTemplatess;
    }

    /**
     * Sets a collection of ChildCKEditorTemplates objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $cKEditorTemplatess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setCKEditorTemplatess(Collection $cKEditorTemplatess, ConnectionInterface $con = null)
    {
        /** @var ChildCKEditorTemplates[] $cKEditorTemplatessToDelete */
        $cKEditorTemplatessToDelete = $this->getCKEditorTemplatess(new Criteria(), $con)->diff($cKEditorTemplatess);


        $this->cKEditorTemplatessScheduledForDeletion = $cKEditorTemplatessToDelete;

        foreach ($cKEditorTemplatessToDelete as $cKEditorTemplatesRemoved) {
            $cKEditorTemplatesRemoved->setPerson(null);
        }

        $this->collCKEditorTemplatess = null;
        foreach ($cKEditorTemplatess as $cKEditorTemplates) {
            $this->addCKEditorTemplates($cKEditorTemplates);
        }

        $this->collCKEditorTemplatess = $cKEditorTemplatess;
        $this->collCKEditorTemplatessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CKEditorTemplates objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CKEditorTemplates objects.
     * @throws PropelException
     */
    public function countCKEditorTemplatess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCKEditorTemplatessPartial && !$this->isNew();
        if (null === $this->collCKEditorTemplatess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCKEditorTemplatess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCKEditorTemplatess());
            }

            $query = ChildCKEditorTemplatesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collCKEditorTemplatess);
    }

    /**
     * Method called to associate a ChildCKEditorTemplates object to this object
     * through the ChildCKEditorTemplates foreign key attribute.
     *
     * @param  ChildCKEditorTemplates $l ChildCKEditorTemplates
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addCKEditorTemplates(ChildCKEditorTemplates $l)
    {
        if ($this->collCKEditorTemplatess === null) {
            $this->initCKEditorTemplatess();
            $this->collCKEditorTemplatessPartial = true;
        }

        if (!$this->collCKEditorTemplatess->contains($l)) {
            $this->doAddCKEditorTemplates($l);

            if ($this->cKEditorTemplatessScheduledForDeletion and $this->cKEditorTemplatessScheduledForDeletion->contains($l)) {
                $this->cKEditorTemplatessScheduledForDeletion->remove($this->cKEditorTemplatessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCKEditorTemplates $cKEditorTemplates The ChildCKEditorTemplates object to add.
     */
    protected function doAddCKEditorTemplates(ChildCKEditorTemplates $cKEditorTemplates)
    {
        $this->collCKEditorTemplatess[]= $cKEditorTemplates;
        $cKEditorTemplates->setPerson($this);
    }

    /**
     * @param  ChildCKEditorTemplates $cKEditorTemplates The ChildCKEditorTemplates object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeCKEditorTemplates(ChildCKEditorTemplates $cKEditorTemplates)
    {
        if ($this->getCKEditorTemplatess()->contains($cKEditorTemplates)) {
            $pos = $this->collCKEditorTemplatess->search($cKEditorTemplates);
            $this->collCKEditorTemplatess->remove($pos);
            if (null === $this->cKEditorTemplatessScheduledForDeletion) {
                $this->cKEditorTemplatessScheduledForDeletion = clone $this->collCKEditorTemplatess;
                $this->cKEditorTemplatessScheduledForDeletion->clear();
            }
            $this->cKEditorTemplatessScheduledForDeletion[]= clone $cKEditorTemplates;
            $cKEditorTemplates->setPerson(null);
        }

        return $this;
    }

    /**
     * Clears out the collPastoralCaresRelatedByPastorId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPastoralCaresRelatedByPastorId()
     */
    public function clearPastoralCaresRelatedByPastorId()
    {
        $this->collPastoralCaresRelatedByPastorId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPastoralCaresRelatedByPastorId collection loaded partially.
     */
    public function resetPartialPastoralCaresRelatedByPastorId($v = true)
    {
        $this->collPastoralCaresRelatedByPastorIdPartial = $v;
    }

    /**
     * Initializes the collPastoralCaresRelatedByPastorId collection.
     *
     * By default this just sets the collPastoralCaresRelatedByPastorId collection to an empty array (like clearcollPastoralCaresRelatedByPastorId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPastoralCaresRelatedByPastorId($overrideExisting = true)
    {
        if (null !== $this->collPastoralCaresRelatedByPastorId && !$overrideExisting) {
            return;
        }

        $collectionClassName = PastoralCareTableMap::getTableMap()->getCollectionClassName();

        $this->collPastoralCaresRelatedByPastorId = new $collectionClassName;
        $this->collPastoralCaresRelatedByPastorId->setModel('\EcclesiaCRM\PastoralCare');
    }

    /**
     * Gets an array of ChildPastoralCare objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPastoralCare[] List of ChildPastoralCare objects
     * @throws PropelException
     */
    public function getPastoralCaresRelatedByPastorId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPastoralCaresRelatedByPastorIdPartial && !$this->isNew();
        if (null === $this->collPastoralCaresRelatedByPastorId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPastoralCaresRelatedByPastorId) {
                // return empty collection
                $this->initPastoralCaresRelatedByPastorId();
            } else {
                $collPastoralCaresRelatedByPastorId = ChildPastoralCareQuery::create(null, $criteria)
                    ->filterByPersonRelatedByPastorId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPastoralCaresRelatedByPastorIdPartial && count($collPastoralCaresRelatedByPastorId)) {
                        $this->initPastoralCaresRelatedByPastorId(false);

                        foreach ($collPastoralCaresRelatedByPastorId as $obj) {
                            if (false == $this->collPastoralCaresRelatedByPastorId->contains($obj)) {
                                $this->collPastoralCaresRelatedByPastorId->append($obj);
                            }
                        }

                        $this->collPastoralCaresRelatedByPastorIdPartial = true;
                    }

                    return $collPastoralCaresRelatedByPastorId;
                }

                if ($partial && $this->collPastoralCaresRelatedByPastorId) {
                    foreach ($this->collPastoralCaresRelatedByPastorId as $obj) {
                        if ($obj->isNew()) {
                            $collPastoralCaresRelatedByPastorId[] = $obj;
                        }
                    }
                }

                $this->collPastoralCaresRelatedByPastorId = $collPastoralCaresRelatedByPastorId;
                $this->collPastoralCaresRelatedByPastorIdPartial = false;
            }
        }

        return $this->collPastoralCaresRelatedByPastorId;
    }

    /**
     * Sets a collection of ChildPastoralCare objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pastoralCaresRelatedByPastorId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setPastoralCaresRelatedByPastorId(Collection $pastoralCaresRelatedByPastorId, ConnectionInterface $con = null)
    {
        /** @var ChildPastoralCare[] $pastoralCaresRelatedByPastorIdToDelete */
        $pastoralCaresRelatedByPastorIdToDelete = $this->getPastoralCaresRelatedByPastorId(new Criteria(), $con)->diff($pastoralCaresRelatedByPastorId);


        $this->pastoralCaresRelatedByPastorIdScheduledForDeletion = $pastoralCaresRelatedByPastorIdToDelete;

        foreach ($pastoralCaresRelatedByPastorIdToDelete as $pastoralCareRelatedByPastorIdRemoved) {
            $pastoralCareRelatedByPastorIdRemoved->setPersonRelatedByPastorId(null);
        }

        $this->collPastoralCaresRelatedByPastorId = null;
        foreach ($pastoralCaresRelatedByPastorId as $pastoralCareRelatedByPastorId) {
            $this->addPastoralCareRelatedByPastorId($pastoralCareRelatedByPastorId);
        }

        $this->collPastoralCaresRelatedByPastorId = $pastoralCaresRelatedByPastorId;
        $this->collPastoralCaresRelatedByPastorIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PastoralCare objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PastoralCare objects.
     * @throws PropelException
     */
    public function countPastoralCaresRelatedByPastorId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPastoralCaresRelatedByPastorIdPartial && !$this->isNew();
        if (null === $this->collPastoralCaresRelatedByPastorId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPastoralCaresRelatedByPastorId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPastoralCaresRelatedByPastorId());
            }

            $query = ChildPastoralCareQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonRelatedByPastorId($this)
                ->count($con);
        }

        return count($this->collPastoralCaresRelatedByPastorId);
    }

    /**
     * Method called to associate a ChildPastoralCare object to this object
     * through the ChildPastoralCare foreign key attribute.
     *
     * @param  ChildPastoralCare $l ChildPastoralCare
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addPastoralCareRelatedByPastorId(ChildPastoralCare $l)
    {
        if ($this->collPastoralCaresRelatedByPastorId === null) {
            $this->initPastoralCaresRelatedByPastorId();
            $this->collPastoralCaresRelatedByPastorIdPartial = true;
        }

        if (!$this->collPastoralCaresRelatedByPastorId->contains($l)) {
            $this->doAddPastoralCareRelatedByPastorId($l);

            if ($this->pastoralCaresRelatedByPastorIdScheduledForDeletion and $this->pastoralCaresRelatedByPastorIdScheduledForDeletion->contains($l)) {
                $this->pastoralCaresRelatedByPastorIdScheduledForDeletion->remove($this->pastoralCaresRelatedByPastorIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPastoralCare $pastoralCareRelatedByPastorId The ChildPastoralCare object to add.
     */
    protected function doAddPastoralCareRelatedByPastorId(ChildPastoralCare $pastoralCareRelatedByPastorId)
    {
        $this->collPastoralCaresRelatedByPastorId[]= $pastoralCareRelatedByPastorId;
        $pastoralCareRelatedByPastorId->setPersonRelatedByPastorId($this);
    }

    /**
     * @param  ChildPastoralCare $pastoralCareRelatedByPastorId The ChildPastoralCare object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removePastoralCareRelatedByPastorId(ChildPastoralCare $pastoralCareRelatedByPastorId)
    {
        if ($this->getPastoralCaresRelatedByPastorId()->contains($pastoralCareRelatedByPastorId)) {
            $pos = $this->collPastoralCaresRelatedByPastorId->search($pastoralCareRelatedByPastorId);
            $this->collPastoralCaresRelatedByPastorId->remove($pos);
            if (null === $this->pastoralCaresRelatedByPastorIdScheduledForDeletion) {
                $this->pastoralCaresRelatedByPastorIdScheduledForDeletion = clone $this->collPastoralCaresRelatedByPastorId;
                $this->pastoralCaresRelatedByPastorIdScheduledForDeletion->clear();
            }
            $this->pastoralCaresRelatedByPastorIdScheduledForDeletion[]= $pastoralCareRelatedByPastorId;
            $pastoralCareRelatedByPastorId->setPersonRelatedByPastorId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related PastoralCaresRelatedByPastorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPastoralCare[] List of ChildPastoralCare objects
     */
    public function getPastoralCaresRelatedByPastorIdJoinPastoralCareType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPastoralCareQuery::create(null, $criteria);
        $query->joinWith('PastoralCareType', $joinBehavior);

        return $this->getPastoralCaresRelatedByPastorId($query, $con);
    }

    /**
     * Clears out the collPastoralCaresRelatedByPersonId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPastoralCaresRelatedByPersonId()
     */
    public function clearPastoralCaresRelatedByPersonId()
    {
        $this->collPastoralCaresRelatedByPersonId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPastoralCaresRelatedByPersonId collection loaded partially.
     */
    public function resetPartialPastoralCaresRelatedByPersonId($v = true)
    {
        $this->collPastoralCaresRelatedByPersonIdPartial = $v;
    }

    /**
     * Initializes the collPastoralCaresRelatedByPersonId collection.
     *
     * By default this just sets the collPastoralCaresRelatedByPersonId collection to an empty array (like clearcollPastoralCaresRelatedByPersonId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPastoralCaresRelatedByPersonId($overrideExisting = true)
    {
        if (null !== $this->collPastoralCaresRelatedByPersonId && !$overrideExisting) {
            return;
        }

        $collectionClassName = PastoralCareTableMap::getTableMap()->getCollectionClassName();

        $this->collPastoralCaresRelatedByPersonId = new $collectionClassName;
        $this->collPastoralCaresRelatedByPersonId->setModel('\EcclesiaCRM\PastoralCare');
    }

    /**
     * Gets an array of ChildPastoralCare objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPastoralCare[] List of ChildPastoralCare objects
     * @throws PropelException
     */
    public function getPastoralCaresRelatedByPersonId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPastoralCaresRelatedByPersonIdPartial && !$this->isNew();
        if (null === $this->collPastoralCaresRelatedByPersonId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPastoralCaresRelatedByPersonId) {
                // return empty collection
                $this->initPastoralCaresRelatedByPersonId();
            } else {
                $collPastoralCaresRelatedByPersonId = ChildPastoralCareQuery::create(null, $criteria)
                    ->filterByPersonRelatedByPersonId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPastoralCaresRelatedByPersonIdPartial && count($collPastoralCaresRelatedByPersonId)) {
                        $this->initPastoralCaresRelatedByPersonId(false);

                        foreach ($collPastoralCaresRelatedByPersonId as $obj) {
                            if (false == $this->collPastoralCaresRelatedByPersonId->contains($obj)) {
                                $this->collPastoralCaresRelatedByPersonId->append($obj);
                            }
                        }

                        $this->collPastoralCaresRelatedByPersonIdPartial = true;
                    }

                    return $collPastoralCaresRelatedByPersonId;
                }

                if ($partial && $this->collPastoralCaresRelatedByPersonId) {
                    foreach ($this->collPastoralCaresRelatedByPersonId as $obj) {
                        if ($obj->isNew()) {
                            $collPastoralCaresRelatedByPersonId[] = $obj;
                        }
                    }
                }

                $this->collPastoralCaresRelatedByPersonId = $collPastoralCaresRelatedByPersonId;
                $this->collPastoralCaresRelatedByPersonIdPartial = false;
            }
        }

        return $this->collPastoralCaresRelatedByPersonId;
    }

    /**
     * Sets a collection of ChildPastoralCare objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pastoralCaresRelatedByPersonId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setPastoralCaresRelatedByPersonId(Collection $pastoralCaresRelatedByPersonId, ConnectionInterface $con = null)
    {
        /** @var ChildPastoralCare[] $pastoralCaresRelatedByPersonIdToDelete */
        $pastoralCaresRelatedByPersonIdToDelete = $this->getPastoralCaresRelatedByPersonId(new Criteria(), $con)->diff($pastoralCaresRelatedByPersonId);


        $this->pastoralCaresRelatedByPersonIdScheduledForDeletion = $pastoralCaresRelatedByPersonIdToDelete;

        foreach ($pastoralCaresRelatedByPersonIdToDelete as $pastoralCareRelatedByPersonIdRemoved) {
            $pastoralCareRelatedByPersonIdRemoved->setPersonRelatedByPersonId(null);
        }

        $this->collPastoralCaresRelatedByPersonId = null;
        foreach ($pastoralCaresRelatedByPersonId as $pastoralCareRelatedByPersonId) {
            $this->addPastoralCareRelatedByPersonId($pastoralCareRelatedByPersonId);
        }

        $this->collPastoralCaresRelatedByPersonId = $pastoralCaresRelatedByPersonId;
        $this->collPastoralCaresRelatedByPersonIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PastoralCare objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PastoralCare objects.
     * @throws PropelException
     */
    public function countPastoralCaresRelatedByPersonId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPastoralCaresRelatedByPersonIdPartial && !$this->isNew();
        if (null === $this->collPastoralCaresRelatedByPersonId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPastoralCaresRelatedByPersonId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPastoralCaresRelatedByPersonId());
            }

            $query = ChildPastoralCareQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonRelatedByPersonId($this)
                ->count($con);
        }

        return count($this->collPastoralCaresRelatedByPersonId);
    }

    /**
     * Method called to associate a ChildPastoralCare object to this object
     * through the ChildPastoralCare foreign key attribute.
     *
     * @param  ChildPastoralCare $l ChildPastoralCare
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addPastoralCareRelatedByPersonId(ChildPastoralCare $l)
    {
        if ($this->collPastoralCaresRelatedByPersonId === null) {
            $this->initPastoralCaresRelatedByPersonId();
            $this->collPastoralCaresRelatedByPersonIdPartial = true;
        }

        if (!$this->collPastoralCaresRelatedByPersonId->contains($l)) {
            $this->doAddPastoralCareRelatedByPersonId($l);

            if ($this->pastoralCaresRelatedByPersonIdScheduledForDeletion and $this->pastoralCaresRelatedByPersonIdScheduledForDeletion->contains($l)) {
                $this->pastoralCaresRelatedByPersonIdScheduledForDeletion->remove($this->pastoralCaresRelatedByPersonIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPastoralCare $pastoralCareRelatedByPersonId The ChildPastoralCare object to add.
     */
    protected function doAddPastoralCareRelatedByPersonId(ChildPastoralCare $pastoralCareRelatedByPersonId)
    {
        $this->collPastoralCaresRelatedByPersonId[]= $pastoralCareRelatedByPersonId;
        $pastoralCareRelatedByPersonId->setPersonRelatedByPersonId($this);
    }

    /**
     * @param  ChildPastoralCare $pastoralCareRelatedByPersonId The ChildPastoralCare object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removePastoralCareRelatedByPersonId(ChildPastoralCare $pastoralCareRelatedByPersonId)
    {
        if ($this->getPastoralCaresRelatedByPersonId()->contains($pastoralCareRelatedByPersonId)) {
            $pos = $this->collPastoralCaresRelatedByPersonId->search($pastoralCareRelatedByPersonId);
            $this->collPastoralCaresRelatedByPersonId->remove($pos);
            if (null === $this->pastoralCaresRelatedByPersonIdScheduledForDeletion) {
                $this->pastoralCaresRelatedByPersonIdScheduledForDeletion = clone $this->collPastoralCaresRelatedByPersonId;
                $this->pastoralCaresRelatedByPersonIdScheduledForDeletion->clear();
            }
            $this->pastoralCaresRelatedByPersonIdScheduledForDeletion[]= clone $pastoralCareRelatedByPersonId;
            $pastoralCareRelatedByPersonId->setPersonRelatedByPersonId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Person is new, it will return
     * an empty collection; or if this Person has previously
     * been saved, it will retrieve related PastoralCaresRelatedByPersonId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Person.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPastoralCare[] List of ChildPastoralCare objects
     */
    public function getPastoralCaresRelatedByPersonIdJoinPastoralCareType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPastoralCareQuery::create(null, $criteria);
        $query->joinWith('PastoralCareType', $joinBehavior);

        return $this->getPastoralCaresRelatedByPersonId($query, $con);
    }

    /**
     * Clears out the collMenuLinks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMenuLinks()
     */
    public function clearMenuLinks()
    {
        $this->collMenuLinks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMenuLinks collection loaded partially.
     */
    public function resetPartialMenuLinks($v = true)
    {
        $this->collMenuLinksPartial = $v;
    }

    /**
     * Initializes the collMenuLinks collection.
     *
     * By default this just sets the collMenuLinks collection to an empty array (like clearcollMenuLinks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMenuLinks($overrideExisting = true)
    {
        if (null !== $this->collMenuLinks && !$overrideExisting) {
            return;
        }

        $collectionClassName = MenuLinkTableMap::getTableMap()->getCollectionClassName();

        $this->collMenuLinks = new $collectionClassName;
        $this->collMenuLinks->setModel('\EcclesiaCRM\MenuLink');
    }

    /**
     * Gets an array of ChildMenuLink objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPerson is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMenuLink[] List of ChildMenuLink objects
     * @throws PropelException
     */
    public function getMenuLinks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMenuLinksPartial && !$this->isNew();
        if (null === $this->collMenuLinks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMenuLinks) {
                // return empty collection
                $this->initMenuLinks();
            } else {
                $collMenuLinks = ChildMenuLinkQuery::create(null, $criteria)
                    ->filterByPerson($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMenuLinksPartial && count($collMenuLinks)) {
                        $this->initMenuLinks(false);

                        foreach ($collMenuLinks as $obj) {
                            if (false == $this->collMenuLinks->contains($obj)) {
                                $this->collMenuLinks->append($obj);
                            }
                        }

                        $this->collMenuLinksPartial = true;
                    }

                    return $collMenuLinks;
                }

                if ($partial && $this->collMenuLinks) {
                    foreach ($this->collMenuLinks as $obj) {
                        if ($obj->isNew()) {
                            $collMenuLinks[] = $obj;
                        }
                    }
                }

                $this->collMenuLinks = $collMenuLinks;
                $this->collMenuLinksPartial = false;
            }
        }

        return $this->collMenuLinks;
    }

    /**
     * Sets a collection of ChildMenuLink objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $menuLinks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function setMenuLinks(Collection $menuLinks, ConnectionInterface $con = null)
    {
        /** @var ChildMenuLink[] $menuLinksToDelete */
        $menuLinksToDelete = $this->getMenuLinks(new Criteria(), $con)->diff($menuLinks);


        $this->menuLinksScheduledForDeletion = $menuLinksToDelete;

        foreach ($menuLinksToDelete as $menuLinkRemoved) {
            $menuLinkRemoved->setPerson(null);
        }

        $this->collMenuLinks = null;
        foreach ($menuLinks as $menuLink) {
            $this->addMenuLink($menuLink);
        }

        $this->collMenuLinks = $menuLinks;
        $this->collMenuLinksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MenuLink objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related MenuLink objects.
     * @throws PropelException
     */
    public function countMenuLinks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMenuLinksPartial && !$this->isNew();
        if (null === $this->collMenuLinks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMenuLinks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMenuLinks());
            }

            $query = ChildMenuLinkQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerson($this)
                ->count($con);
        }

        return count($this->collMenuLinks);
    }

    /**
     * Method called to associate a ChildMenuLink object to this object
     * through the ChildMenuLink foreign key attribute.
     *
     * @param  ChildMenuLink $l ChildMenuLink
     * @return $this|\EcclesiaCRM\Person The current object (for fluent API support)
     */
    public function addMenuLink(ChildMenuLink $l)
    {
        if ($this->collMenuLinks === null) {
            $this->initMenuLinks();
            $this->collMenuLinksPartial = true;
        }

        if (!$this->collMenuLinks->contains($l)) {
            $this->doAddMenuLink($l);

            if ($this->menuLinksScheduledForDeletion and $this->menuLinksScheduledForDeletion->contains($l)) {
                $this->menuLinksScheduledForDeletion->remove($this->menuLinksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMenuLink $menuLink The ChildMenuLink object to add.
     */
    protected function doAddMenuLink(ChildMenuLink $menuLink)
    {
        $this->collMenuLinks[]= $menuLink;
        $menuLink->setPerson($this);
    }

    /**
     * @param  ChildMenuLink $menuLink The ChildMenuLink object to remove.
     * @return $this|ChildPerson The current object (for fluent API support)
     */
    public function removeMenuLink(ChildMenuLink $menuLink)
    {
        if ($this->getMenuLinks()->contains($menuLink)) {
            $pos = $this->collMenuLinks->search($menuLink);
            $this->collMenuLinks->remove($pos);
            if (null === $this->menuLinksScheduledForDeletion) {
                $this->menuLinksScheduledForDeletion = clone $this->collMenuLinks;
                $this->menuLinksScheduledForDeletion->clear();
            }
            $this->menuLinksScheduledForDeletion[]= $menuLink;
            $menuLink->setPerson(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFamily) {
            $this->aFamily->removePerson($this);
        }
        $this->per_id = null;
        $this->per_title = null;
        $this->per_firstname = null;
        $this->per_middlename = null;
        $this->per_lastname = null;
        $this->per_suffix = null;
        $this->per_address1 = null;
        $this->per_address2 = null;
        $this->per_city = null;
        $this->per_state = null;
        $this->per_zip = null;
        $this->per_country = null;
        $this->per_homephone = null;
        $this->per_workphone = null;
        $this->per_cellphone = null;
        $this->per_email = null;
        $this->per_workemail = null;
        $this->per_birthmonth = null;
        $this->per_birthday = null;
        $this->per_birthyear = null;
        $this->per_membershipdate = null;
        $this->per_gender = null;
        $this->per_fmr_id = null;
        $this->per_cls_id = null;
        $this->per_fam_id = null;
        $this->per_envelope = null;
        $this->per_datelastedited = null;
        $this->per_dateentered = null;
        $this->per_enteredby = null;
        $this->per_editedby = null;
        $this->per_frienddate = null;
        $this->per_flags = null;
        $this->per_facebookid = null;
        $this->per_twitter = null;
        $this->per_linkedin = null;
        $this->per_datedeactivated = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->singlePersonCustom) {
                $this->singlePersonCustom->clearAllReferences($deep);
            }
            if ($this->collNotes) {
                foreach ($this->collNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNoteShares) {
                foreach ($this->collNoteShares as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPerson2group2roleP2g2rs) {
                foreach ($this->collPerson2group2roleP2g2rs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAutoPayments) {
                foreach ($this->collAutoPayments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEventAttends) {
                foreach ($this->collEventAttends as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPledges) {
                foreach ($this->collPledges as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleUser) {
                $this->singleUser->clearAllReferences($deep);
            }
            if ($this->collPersonVolunteerOpportunities) {
                foreach ($this->collPersonVolunteerOpportunities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGroupManagerpeople) {
                foreach ($this->collGroupManagerpeople as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCKEditorTemplatess) {
                foreach ($this->collCKEditorTemplatess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPastoralCaresRelatedByPastorId) {
                foreach ($this->collPastoralCaresRelatedByPastorId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPastoralCaresRelatedByPersonId) {
                foreach ($this->collPastoralCaresRelatedByPersonId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMenuLinks) {
                foreach ($this->collMenuLinks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->singlePersonCustom = null;
        $this->collNotes = null;
        $this->collNoteShares = null;
        $this->collPerson2group2roleP2g2rs = null;
        $this->collAutoPayments = null;
        $this->collEventAttends = null;
        $this->collPledges = null;
        $this->singleUser = null;
        $this->collPersonVolunteerOpportunities = null;
        $this->collGroupManagerpeople = null;
        $this->collCKEditorTemplatess = null;
        $this->collPastoralCaresRelatedByPastorId = null;
        $this->collPastoralCaresRelatedByPersonId = null;
        $this->collMenuLinks = null;
        $this->aFamily = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PersonTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
