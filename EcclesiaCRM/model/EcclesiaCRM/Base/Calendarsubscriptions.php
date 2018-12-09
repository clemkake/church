<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\CalendarsubscriptionsQuery as ChildCalendarsubscriptionsQuery;
use EcclesiaCRM\Map\CalendarsubscriptionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'calendarsubscriptions' table.
 *
 * Calendar management
 *
 * @package    propel.generator.EcclesiaCRM.Base
 */
abstract class Calendarsubscriptions implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\EcclesiaCRM\\Map\\CalendarsubscriptionsTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the uri field.
     *
     * @var        string
     */
    protected $uri;

    /**
     * The value for the principaluri field.
     *
     * @var        string
     */
    protected $principaluri;

    /**
     * The value for the source field.
     *
     * @var        string
     */
    protected $source;

    /**
     * The value for the displayname field.
     *
     * @var        string
     */
    protected $displayname;

    /**
     * The value for the refreshrate field.
     *
     * @var        string
     */
    protected $refreshrate;

    /**
     * The value for the calendarorder field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $calendarorder;

    /**
     * The value for the calendarcolor field.
     *
     * @var        string
     */
    protected $calendarcolor;

    /**
     * The value for the striptodos field.
     *
     * @var        boolean
     */
    protected $striptodos;

    /**
     * The value for the stripalarms field.
     *
     * @var        boolean
     */
    protected $stripalarms;

    /**
     * The value for the stripattachments field.
     *
     * @var        boolean
     */
    protected $stripattachments;

    /**
     * The value for the lastmodified field.
     *
     * @var        int
     */
    protected $lastmodified;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->calendarorder = 0;
    }

    /**
     * Initializes internal state of EcclesiaCRM\Base\Calendarsubscriptions object.
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
     * Compares this with another <code>Calendarsubscriptions</code> instance.  If
     * <code>obj</code> is an instance of <code>Calendarsubscriptions</code>, delegates to
     * <code>equals(Calendarsubscriptions)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Calendarsubscriptions The current object, for fluid interface
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [uri] column value.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the [principaluri] column value.
     *
     * @return string
     */
    public function getPrincipaluri()
    {
        return $this->principaluri;
    }

    /**
     * Get the [source] column value.
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Get the [displayname] column value.
     *
     * @return string
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }

    /**
     * Get the [refreshrate] column value.
     *
     * @return string
     */
    public function getRefreshrate()
    {
        return $this->refreshrate;
    }

    /**
     * Get the [calendarorder] column value.
     *
     * @return int
     */
    public function getCalendarorder()
    {
        return $this->calendarorder;
    }

    /**
     * Get the [calendarcolor] column value.
     *
     * @return string
     */
    public function getCalendarcolor()
    {
        return $this->calendarcolor;
    }

    /**
     * Get the [striptodos] column value.
     *
     * @return boolean
     */
    public function getStriptodos()
    {
        return $this->striptodos;
    }

    /**
     * Get the [striptodos] column value.
     *
     * @return boolean
     */
    public function isStriptodos()
    {
        return $this->getStriptodos();
    }

    /**
     * Get the [stripalarms] column value.
     *
     * @return boolean
     */
    public function getStripalarms()
    {
        return $this->stripalarms;
    }

    /**
     * Get the [stripalarms] column value.
     *
     * @return boolean
     */
    public function isStripalarms()
    {
        return $this->getStripalarms();
    }

    /**
     * Get the [stripattachments] column value.
     *
     * @return boolean
     */
    public function getStripattachments()
    {
        return $this->stripattachments;
    }

    /**
     * Get the [stripattachments] column value.
     *
     * @return boolean
     */
    public function isStripattachments()
    {
        return $this->getStripattachments();
    }

    /**
     * Get the [lastmodified] column value.
     *
     * @return int
     */
    public function getLastmodified()
    {
        return $this->lastmodified;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [uri] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setUri($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uri !== $v) {
            $this->uri = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_URI] = true;
        }

        return $this;
    } // setUri()

    /**
     * Set the value of [principaluri] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setPrincipaluri($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->principaluri !== $v) {
            $this->principaluri = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_PRINCIPALURI] = true;
        }

        return $this;
    } // setPrincipaluri()

    /**
     * Set the value of [source] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setSource($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->source !== $v) {
            $this->source = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_SOURCE] = true;
        }

        return $this;
    } // setSource()

    /**
     * Set the value of [displayname] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setDisplayname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->displayname !== $v) {
            $this->displayname = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_DISPLAYNAME] = true;
        }

        return $this;
    } // setDisplayname()

    /**
     * Set the value of [refreshrate] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setRefreshrate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->refreshrate !== $v) {
            $this->refreshrate = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_REFRESHRATE] = true;
        }

        return $this;
    } // setRefreshrate()

    /**
     * Set the value of [calendarorder] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setCalendarorder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->calendarorder !== $v) {
            $this->calendarorder = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_CALENDARORDER] = true;
        }

        return $this;
    } // setCalendarorder()

    /**
     * Set the value of [calendarcolor] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setCalendarcolor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendarcolor !== $v) {
            $this->calendarcolor = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_CALENDARCOLOR] = true;
        }

        return $this;
    } // setCalendarcolor()

    /**
     * Sets the value of the [striptodos] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setStriptodos($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->striptodos !== $v) {
            $this->striptodos = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_STRIPTODOS] = true;
        }

        return $this;
    } // setStriptodos()

    /**
     * Sets the value of the [stripalarms] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setStripalarms($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stripalarms !== $v) {
            $this->stripalarms = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_STRIPALARMS] = true;
        }

        return $this;
    } // setStripalarms()

    /**
     * Sets the value of the [stripattachments] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setStripattachments($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stripattachments !== $v) {
            $this->stripattachments = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS] = true;
        }

        return $this;
    } // setStripattachments()

    /**
     * Set the value of [lastmodified] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object (for fluent API support)
     */
    public function setLastmodified($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lastmodified !== $v) {
            $this->lastmodified = $v;
            $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_LASTMODIFIED] = true;
        }

        return $this;
    } // setLastmodified()

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
            if ($this->calendarorder !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Uri', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uri = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Principaluri', TableMap::TYPE_PHPNAME, $indexType)];
            $this->principaluri = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Source', TableMap::TYPE_PHPNAME, $indexType)];
            $this->source = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Displayname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->displayname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Refreshrate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->refreshrate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Calendarorder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendarorder = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Calendarcolor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendarcolor = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Striptodos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->striptodos = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Stripalarms', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stripalarms = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Stripattachments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stripattachments = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CalendarsubscriptionsTableMap::translateFieldName('Lastmodified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastmodified = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = CalendarsubscriptionsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\EcclesiaCRM\\Calendarsubscriptions'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCalendarsubscriptionsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Calendarsubscriptions::setDeleted()
     * @see Calendarsubscriptions::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCalendarsubscriptionsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
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
                CalendarsubscriptionsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[CalendarsubscriptionsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CalendarsubscriptionsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_URI)) {
            $modifiedColumns[':p' . $index++]  = 'uri';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_PRINCIPALURI)) {
            $modifiedColumns[':p' . $index++]  = 'principaluri';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_SOURCE)) {
            $modifiedColumns[':p' . $index++]  = 'source';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_DISPLAYNAME)) {
            $modifiedColumns[':p' . $index++]  = 'displayname';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_REFRESHRATE)) {
            $modifiedColumns[':p' . $index++]  = 'refreshrate';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_CALENDARORDER)) {
            $modifiedColumns[':p' . $index++]  = 'calendarorder';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_CALENDARCOLOR)) {
            $modifiedColumns[':p' . $index++]  = 'calendarcolor';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_STRIPTODOS)) {
            $modifiedColumns[':p' . $index++]  = 'striptodos';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_STRIPALARMS)) {
            $modifiedColumns[':p' . $index++]  = 'stripalarms';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'stripattachments';
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_LASTMODIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'lastmodified';
        }

        $sql = sprintf(
            'INSERT INTO calendarsubscriptions (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'uri':
                        $stmt->bindValue($identifier, $this->uri, PDO::PARAM_STR);
                        break;
                    case 'principaluri':
                        $stmt->bindValue($identifier, $this->principaluri, PDO::PARAM_STR);
                        break;
                    case 'source':
                        $stmt->bindValue($identifier, $this->source, PDO::PARAM_STR);
                        break;
                    case 'displayname':
                        $stmt->bindValue($identifier, $this->displayname, PDO::PARAM_STR);
                        break;
                    case 'refreshrate':
                        $stmt->bindValue($identifier, $this->refreshrate, PDO::PARAM_STR);
                        break;
                    case 'calendarorder':
                        $stmt->bindValue($identifier, $this->calendarorder, PDO::PARAM_INT);
                        break;
                    case 'calendarcolor':
                        $stmt->bindValue($identifier, $this->calendarcolor, PDO::PARAM_STR);
                        break;
                    case 'striptodos':
                        $stmt->bindValue($identifier, (int) $this->striptodos, PDO::PARAM_INT);
                        break;
                    case 'stripalarms':
                        $stmt->bindValue($identifier, (int) $this->stripalarms, PDO::PARAM_INT);
                        break;
                    case 'stripattachments':
                        $stmt->bindValue($identifier, (int) $this->stripattachments, PDO::PARAM_INT);
                        break;
                    case 'lastmodified':
                        $stmt->bindValue($identifier, $this->lastmodified, PDO::PARAM_INT);
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
        $pos = CalendarsubscriptionsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUri();
                break;
            case 2:
                return $this->getPrincipaluri();
                break;
            case 3:
                return $this->getSource();
                break;
            case 4:
                return $this->getDisplayname();
                break;
            case 5:
                return $this->getRefreshrate();
                break;
            case 6:
                return $this->getCalendarorder();
                break;
            case 7:
                return $this->getCalendarcolor();
                break;
            case 8:
                return $this->getStriptodos();
                break;
            case 9:
                return $this->getStripalarms();
                break;
            case 10:
                return $this->getStripattachments();
                break;
            case 11:
                return $this->getLastmodified();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Calendarsubscriptions'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Calendarsubscriptions'][$this->hashCode()] = true;
        $keys = CalendarsubscriptionsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUri(),
            $keys[2] => $this->getPrincipaluri(),
            $keys[3] => $this->getSource(),
            $keys[4] => $this->getDisplayname(),
            $keys[5] => $this->getRefreshrate(),
            $keys[6] => $this->getCalendarorder(),
            $keys[7] => $this->getCalendarcolor(),
            $keys[8] => $this->getStriptodos(),
            $keys[9] => $this->getStripalarms(),
            $keys[10] => $this->getStripattachments(),
            $keys[11] => $this->getLastmodified(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     * @return $this|\EcclesiaCRM\Calendarsubscriptions
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CalendarsubscriptionsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\EcclesiaCRM\Calendarsubscriptions
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUri($value);
                break;
            case 2:
                $this->setPrincipaluri($value);
                break;
            case 3:
                $this->setSource($value);
                break;
            case 4:
                $this->setDisplayname($value);
                break;
            case 5:
                $this->setRefreshrate($value);
                break;
            case 6:
                $this->setCalendarorder($value);
                break;
            case 7:
                $this->setCalendarcolor($value);
                break;
            case 8:
                $this->setStriptodos($value);
                break;
            case 9:
                $this->setStripalarms($value);
                break;
            case 10:
                $this->setStripattachments($value);
                break;
            case 11:
                $this->setLastmodified($value);
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
        $keys = CalendarsubscriptionsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUri($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPrincipaluri($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSource($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDisplayname($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRefreshrate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCalendarorder($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCalendarcolor($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStriptodos($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStripalarms($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setStripattachments($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLastmodified($arr[$keys[11]]);
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
     * @return $this|\EcclesiaCRM\Calendarsubscriptions The current object, for fluid interface
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
        $criteria = new Criteria(CalendarsubscriptionsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_ID)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_URI)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_URI, $this->uri);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_PRINCIPALURI)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_PRINCIPALURI, $this->principaluri);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_SOURCE)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_SOURCE, $this->source);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_DISPLAYNAME)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_DISPLAYNAME, $this->displayname);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_REFRESHRATE)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_REFRESHRATE, $this->refreshrate);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_CALENDARORDER)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_CALENDARORDER, $this->calendarorder);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_CALENDARCOLOR)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_CALENDARCOLOR, $this->calendarcolor);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_STRIPTODOS)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_STRIPTODOS, $this->striptodos);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_STRIPALARMS)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_STRIPALARMS, $this->stripalarms);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS, $this->stripattachments);
        }
        if ($this->isColumnModified(CalendarsubscriptionsTableMap::COL_LASTMODIFIED)) {
            $criteria->add(CalendarsubscriptionsTableMap::COL_LASTMODIFIED, $this->lastmodified);
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
        $criteria = ChildCalendarsubscriptionsQuery::create();
        $criteria->add(CalendarsubscriptionsTableMap::COL_ID, $this->id);

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
     * Generic method to set the primary key (id column).
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
     * @param      object $copyObj An object of \EcclesiaCRM\Calendarsubscriptions (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUri($this->getUri());
        $copyObj->setPrincipaluri($this->getPrincipaluri());
        $copyObj->setSource($this->getSource());
        $copyObj->setDisplayname($this->getDisplayname());
        $copyObj->setRefreshrate($this->getRefreshrate());
        $copyObj->setCalendarorder($this->getCalendarorder());
        $copyObj->setCalendarcolor($this->getCalendarcolor());
        $copyObj->setStriptodos($this->getStriptodos());
        $copyObj->setStripalarms($this->getStripalarms());
        $copyObj->setStripattachments($this->getStripattachments());
        $copyObj->setLastmodified($this->getLastmodified());
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
     * @return \EcclesiaCRM\Calendarsubscriptions Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->uri = null;
        $this->principaluri = null;
        $this->source = null;
        $this->displayname = null;
        $this->refreshrate = null;
        $this->calendarorder = null;
        $this->calendarcolor = null;
        $this->striptodos = null;
        $this->stripalarms = null;
        $this->stripattachments = null;
        $this->lastmodified = null;
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
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CalendarsubscriptionsTableMap::DEFAULT_STRING_FORMAT);
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
