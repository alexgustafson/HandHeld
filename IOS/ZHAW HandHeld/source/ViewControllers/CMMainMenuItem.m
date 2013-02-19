//
//  CMMainMenuItem.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 17.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "CMMainMenuItem.h"

@implementation CMMainMenuItem
@synthesize buttonImageUp, label, field, dbManager, imageUp, imageDown, linkedArticleID;



- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [[[[NSBundle mainBundle] loadNibNamed:@"CMMainMenuItem" owner:self options:nil] objectAtIndex:0] retain];
    if (self) {
        [self setButtonImageUp:[[UIImageView alloc] initWithFrame:CGRectMake(220, (self.frame.size.height/2) - 50, 100, 100)]];
        
        [self addSubview:[self buttonImageUp]];
    }
    return self;
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated
{
    [super setSelected:selected animated:animated];
    [[self buttonImageUp] setFrame:CGRectMake(220, (self.frame.size.height/2) - 50, 100, 100)];

    [self setBackgroundColor:backgroundColor];

    // Configure the view for the selected state
    
    if (selected) {

        [[self buttonImageUp] setImage:[self imageDown]];


    }else{
        [[self buttonImageUp] setImage:[self imageUp]];
    }
    
}

- (void)initializeWithField:(HHFieldModel *)f andHHManager:(SqLiteDatabaseManager*)db
{
    [self setField:f];
    [self setDbManager:db];
    
    for (id key in [[self field] children]) {
        
        HHFieldModel* dataField = [[[self field] children] objectForKey:key];
        
        if ([dataField.fieldTypeName isEqualToString:@"link_to_article"]) {
            
            [self setLinkedArticleID:[dataField data]];
            
            
        }else if ([dataField.fieldTypeName isEqualToString:@"text"])
        {
            [[self label] setText:[dataField data]];
            
        }else if ([dataField.fieldTypeName isEqualToString:@"resource_path"])
        {
         
            if ([dataField.name isEqualToString:@"Button Image Normal"])
            {
                [self setImageUp:[dataField getImageForResource]];
                [[self buttonImageUp] setImage:[self imageUp]];
                
                
            }else if([dataField.name isEqualToString:@"Button Image Pressed"])
            {
                [self setImageDown:[dataField getImageForResource]];
            }
            
            
        }else if ([dataField.fieldTypeName isEqualToString:@"color"])
        {
            if ([dataField.name isEqualToString:@"Background Color"])
            {
                backgroundColor = [dataField getColor];
                
            }
        }

    }
    
    
    
}






@end
